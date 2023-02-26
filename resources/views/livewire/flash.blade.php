<div x-data="{open:false}" @flash-message.window="open=true; setTimeout(()=>open=false
    ,3000);" 
    class="py-4 px-6">
  <div x-show="open" x-cloak  class="border border-warning text-warning bg-warning {{$type? $colors[$type]:''}} font-semibold py-3 px-2">
   {{$message}}
  </div>
</div>
