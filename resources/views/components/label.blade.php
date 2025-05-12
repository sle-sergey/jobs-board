<label class="block text-slate-700 text-sm font-medium mb-2"
for="{{ $for }}">
    {{ $slot }} @if($required) <span class="text-red-500">*</span> @endif
</label>
