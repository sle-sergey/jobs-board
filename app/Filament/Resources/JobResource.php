<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Employer;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data')->schema([
                    TextInput::make('title')->required(),
                    TextInput::make('location')->required(),
                    MarkdownEditor::make('description')->required()->columnSpan("full"),

                ])->columnSpan(3)->columns(2),

                Section::make('Meta')->schema([
                    TextInput::make('salary')->required(),
                    Select::make('category')->options(
                        collect(Job::$category)->mapWithKeys(fn($item) => [$item => ucfirst($item)])
                    )->required(),

                    Select::make('experience')->options(
                        collect(Job::$experience)->mapWithKeys(fn($item) => [$item => ucfirst($item)])
                    )->required(),
                    Select::make('employer_id')
                        ->relationship('employer', 'company_name')
                        ->searchable(),
                ])->columnSpan(1)->columns(1),

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->toggleable(),
                TextColumn::make('created_at')->sortable()->toggleable(),
//                TextColumn::make('created_at')->label('Last updated')->dateTime()
//                    ->sortable()->toggleable(),
                TextColumn::make('description')->toggleable(),
                TextColumn::make('salary')->searchable()->toggleable(),
                TextColumn::make('category')->searchable()->toggleable(),
                TextColumn::make('experience')->searchable()->toggleable(),
                TextColumn::make('location')->searchable()->sortable()->toggleable(),
                TextColumn::make('employer.company_name')->label('Employer')->sortable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('location')
                    ->options([
                        'Calgary' => 'Calgary',
                        'Hoegerchester' => 'Hoegerchester',
                        'South Destinee' => 'South Destinee',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
