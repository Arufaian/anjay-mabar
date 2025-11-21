 <x-app-layout>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

             <div class="flex gap-6 flex-col md:flex-row w-full">

                 <section class="card bg-base-100 shadow-xl">
                     <div class="card-body">
                         <div class="max-w-xl w-full mx-auto">
                             @include('profile.partials.update-profile-information-form')
                         </div>
                     </div>
                 </section>

                 <section class="card bg-base-100 shadow-xl w-full">
                     <div class="card-body">
                         <div class="max-w-xl w-full mx-auto">
                             @include('profile.partials.update-password-form')
                         </div>
                     </div>
                 </section>

             </div>

             <section class="card bg-base-100 shadow-xl">
                 <div class="card-body">
                     <div class="max-w-xl w-full">
                         @include('profile.partials.delete-user-form')
                     </div>
                 </div>
             </section>
         </div>
     </div>
 </x-app-layout>
