<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div><br>
            
              <button  style="background-color: lightblue; color: black; text-align:center; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-weight: bold; font-size: 25px" >
             <a  href="{{ route('generate.tableview.index.post')}}">ADD URL</a>
            </button>    
        </div>
    </div>
   
</x-app-layout>
