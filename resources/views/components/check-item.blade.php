<div class="flex items-center mb-4">
  <input id="item-{{$id}}" type="checkbox" value="{{$id}}" {{$checked}} @if($disabled) disabled @endif
    class="checkbox-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
  <label for="item-{{$id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$deskripsi}}</label>
</div>