<x-card class="mb-4" :$job >
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{$job->title}}</h2>
        <div class="text-slate-500 text-sm">
            ${{number_format($job->salary, 2)}}
        </div>
    </div>

    <div class="mb-4 flex justify-between items-center text-sm text-slate-500">
        <div class="flex items-center space-x-4">
            <div>{{$job->employer->company_name}}</div>
            <div>
                <a href="{{route('jobs.index', ['location' => $job->location])}}">
                {{$job->location}}</a>
            </div>
            @if($job->deleted_at)
                <span class="text-red-500">Deleted</span>
            @endif
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
            <a href="{{route('jobs.index', ['experience' => $job->experience])}}">
                {{ Str::ucfirst($job->experience) }}</a>
            </x-tag>
            <a href="{{route('jobs.index', ['category' => $job->category])}}">
            <x-tag>{{$job->category}}</x-tag></a>
        </div>
    </div>
    {{ $slot }}
</x-card>
