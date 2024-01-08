<section class="">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
          <img class="mr-2" src="{{asset('logo/logo.png')}}" alt="logo">
      </a>
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 border border-gray-300">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <form  wire:submit.prevent="authenticate" class="space-y-4 md:space-y-6" action="#">
                  <div>
                      <label for="userid" class="block mb-2 text-sm font-medium text-gray-900">User ID</label>
                      <input type="text" wire:model="userid" name="userid" id="userid" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" placeholder="User ID" required="">
                  </div>
                  <div>
                      <label for="password"  class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                      <input type="password" wire:model="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500" required="">
                  </div>
                  <button type="submit" class=" w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Login</button>
              </form>
          </div>
      </div>
  </div>

</section>

