<div>
    <div class="sm:col-span-2">
        <dt class="text-lg font-medium ">{{$record->name}}</dt>
       
      </div>
      @if($record->sections->isNotEmpty())
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Sections</dt>
        <dd class="mt-1 text-sm text-gray-900">
          <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
            @forelse ($record->sections as  $section)
                
            
            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                <div class="flex w-0 flex-1 items-center">
                    
                    <span class="ml-2 w-0 flex-1 truncate">{{$section->name}}</span>
                </div>
                
            </li>
            @empty
            @endforelse
            
          </ul>
        </dd>
      </div>
      @endif
</div>
</div>
