


<div>



    <div>
        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-20 lg:flex lg:w-80 lg:flex-col">
         <!-- Sidebar component, swap this element with another sidebar if you like -->
         <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4 w-[22rem]">
            <div class="mt-3 flex h-16 shrink-0 items-center ">
                <!-- Dropdown Container -->
                {{-- <img class="h-14 w-14" src="{{asset('images/sksu_logo.png')}}" alt="Your Company"> --}}


                <!-- System Title -->
                {{-- <div>
                    <p class="text-xl font-bold text-sksu-800">{{Auth::user()->name ??''}}</p>
                    <p class="text-xs drop-shadow-sm text-sksu-900">{{Auth::user()->email}}</p>
                </div> --}}
                <div class="flex justify-center items-center text-center flex-col mt-24">
                    <p class="text-center text-5xl font-bold text-sksu-900">ETMS</p>
                    <p class="text-center text-sm mt-1 drop-shadow-sm text-sksu-900">Equipment Tracking Management System</p>
                </div>
            </div>





           <nav class="flex flex-1 flex-col mt-8 ">
             <ul role="list" class="flex flex-1 flex-col gap-y-7 ">
                 <li>
                     <ul role="list" class="-mx-2 space-y-1  ">

                         {{-- <div class="text-sm font-semibold leading-6 text-gray-400"></div> --}}
                         @can('is-admin')
                         <ul role="list" class="-mx-2 mt-2 space-y-1">
                             <li class=" mb-6">
                                 <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                 <a href="#"
                                 class="inactive-link">
                                 <div class="flex justify-center items-center">

                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                </div>

                                <span class="ml-2 truncate">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                    @can('is-admin')
                    <div class="mt-6">
                        <li class="">
                            <div class="text-sm font-semibold leading-6 text-sksu-800">TRANSACTION </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li>
                                  <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                  <a href="{{route('equipment.index')}}"
                                  class=" {{RouteManager::isCurrentPage(Session::get('current_route_name'),['equipment.index','equipment.create','equipment.edit'],'active-link','inactive-link') }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                   </svg>

                                    <span class="ml-2 truncate">Equipment</span>
                                  </a>
                                </li>
                                <li>
                                  <a href="{{route('requests.lisofequipmentrequests')}}"
                                  class="{{RouteManager::isCurrentPage(Session::get('current_route_name'),['requests.lisofequipmentrequests'],'active-link','inactive-link') }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                   </svg>


                                    <span class="ml-2 truncate">Request</span>
                                    <div>
                                        <span class="inline-flex items-center justify-center px-1.5 py-1 text-xs rubik-500 leading-none text-green-100 bg-green-600 rounded-full">
                                        40
                                        </span>

                                  </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="#"
                                  class="inactive-link">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                   </svg>

                                    <span class="ml-2 truncate">Reports</span>
                                  </a>
                                </li>

                              </ul>
                        </li>
                    </div>
                    @endcan
                    @can('is-admin')
                    <div class="">
                        <li class="mt-8">
                            <div class="text-sm font-semibold leading-6 text-sksu-800">CONTENT </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li>
                                  <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                  <a href="{{route('department.index')}}"
                                  class="{{RouteManager::isCurrentPage(Session::get('current_route_name'),['department.index','department.create','department.edit'],'active-link','inactive-link') }}">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 ">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                        </svg>
                                    <span class="ml-2 truncate">Department</span>
                                  </a>
                                </li>
                                <li>
                                  <a href="{{route('courses.index')}}"
                                  class="{{RouteManager::isCurrentPage(Session::get('current_route_name'),['courses.index','courses.create','courses.edit'],'active-link','inactive-link') }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 ">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                   </svg>

                                    <span class="ml-2 truncate">Course</span>
                                  </a>
                                </li>
                                <li>
                                  <a href="{{route('sections.index')}}"
                                  class="{{RouteManager::isCurrentPage(Session::get('current_route_name'),['sections.index','sections.create','sections.edit'],'active-link','inactive-link') }}">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 ">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                    <span class="ml-2 truncate">Section</span>
                                  </a>
                                </li>

                              </ul>
                        </li>
                    </div>
                    @endcan

                    @can('is-requester')
                    <div class="mt-6">
                      
                        <li class="">
                            {{-- <div class="text-sm font-semibold leading-6 text-sksu-800">TRANSACTION </div> --}}
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                              <li>
                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                <a href="{{route('equipment.list')}}"
                                class=" {{RouteManager::isCurrentPage(Session::get('current_route_name'),['equipment.list'],'active-link','inactive-link') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                 </svg>

                                  <span class="ml-2 truncate">Equipment</span>
                                </a>
                              </li>
                              

                                <li>
                                  <a href="{{route('requests.index')}}"
                                  class="{{RouteManager::isCurrentPage(Session::get('current_route_name'),['requests.index','requests.create','requests.edit','requests.view'],'active-link','inactive-link') }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                   </svg>


                                    <span class="ml-2 truncate">My Request</span>
                                    <div>
                                        <span class="inline-flex items-center justify-center px-1.5 py-1 text-xs rubik-500 leading-none text-green-100 bg-green-600 rounded-full">
                                        40
                                        </span>

                                  </div>
                                  </a>
                                </li>


                              </ul>
                        </li>
                    </div>
                    @endcan




                 </ul>
               </li>

               <li class="mt-auto">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <!-- Button to Open Dropdown -->
                    <button
                        @click="dropdownOpen = !dropdownOpen"
                        type="button"
                        class="group -mx-2 flex gap-x-3 rounded-md p-2 text-lg leading-6 text-gray-700 hover:bg-gray-50 hover:text-green-600 w-full"
                        id="user-menu-button"
                    >
                        <span class="sr-only">Open user menu</span>

                        {{-- <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        <p>
                            Logout

                        </p> --}}
 <img
                            class="h-10 w-10 rounded-full object-cover border-4 border-sksu-700"
                            src="{{Auth::user()->getImage()}}"
                            alt="Profile"
                        >
                         <div>
                    <p class="text-lg ">{{Auth::user()->name ??''}}</p>
                    <p class="text-xs drop-shadow-sm text-gray-700">{{Auth::user()->email}}</p>
                </div>

                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        x-show="dropdownOpen"
                        @click.outside="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="absolute bottom-0 right-0 z-50 mt-[-10rem] w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                    >
                        <!-- Dropdown Options -->
                        <x-dropdown-link href="{{ Auth::user()->getImage() }}" target="_blank">
                            {{ __('View Image') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('edit-profile', ['record' => Auth::user()]) }}">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>

                <!-- Static Logout Button in Bottom Navigation -->
                {{-- <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button class="group -mx-2 flex gap-x-3 rounded-md p-2 text-lg leading-6 text-gray-700 hover:bg-gray-50 hover:text-green-600 w-full">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Logout
                    </button>
                </form> --}}
            </li>

             </ul>
           </nav>

         </div>
       </div>
 </div>

    <div class="lg:pl-72  mx-auto ">

        <div class=" p-16 lg:pt-16 lg:px-24  ">
          <div class="text-4xl font-semibold text-gray-700 rubik-400 mb-8">
            @yield('title')
        </div>
            {{$slot}}

        </div>
      </main>
    </div>
  </div>



