<div class="relative w-full">
  <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer 
    @if($disabled) bg-zinc-100 cursor-not-allowed @endif" placeholder=" " value="{{ $value }}" @if($disabled) disabled
    @endif />

  <label for="{{ $name }}"
    class="absolute cursor-pointer text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0]  dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1  @if($disabled) @endif" ">{{ $label }}</label>
</div>