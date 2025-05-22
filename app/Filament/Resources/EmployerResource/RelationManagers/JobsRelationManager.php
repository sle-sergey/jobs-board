<?php

namespace App\Filament\Resources\EmployerResource\RelationManagers;

use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobsRelationManager extends RelationManager
{
    protected static string $relationship = 'jobs';

    public function form(Form $form): Form
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
//                    Select::make('employer_id')
//                        ->relationship('employer', 'company_name')
//                        ->searchable(),
                ])->columnSpan(1)->columns(1),

            ])->columns(4);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->toggleable(),
                TextColumn::make('description')->toggleable(),
                TextColumn::make('salary')->searchable()->toggleable(),
                TextColumn::make('category')->searchable()->toggleable(),
                TextColumn::make('experience')->searchable()->toggleable(),
                TextColumn::make('location')->searchable()->sortable()->toggleable(),
                TextColumn::make('employer.company_name')->label('Employer')->sortable()->toggleable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
