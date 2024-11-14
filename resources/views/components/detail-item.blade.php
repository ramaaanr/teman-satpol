<!-- resources/views/components/detail-item.blade.php -->
<div class="detail-item w-full flex flex-col" id="{{ $id }}">
  <label for="{{ $id }}" class="text-zinc-400 text-xs">{{ $label }}</label>
  <span class="value-display text-zinc-700 font-semibold">{{ $value }}</span>
</div>