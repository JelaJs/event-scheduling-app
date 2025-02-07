<div class="flex items-center">
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a class="text-white" href="/">Home</a>
              <a class="text-white" href="/jobs">Restaurants</a>
              <a class="text-white" href="/contact">Bands</a>
            </div>
          </div>
        </div>
        @if (Auth::user())     
            <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              @if (Auth::user()->role === 'customer')
              <a class="text-white mr-3 p-2 bg-gray-900 rounded-full" href="{{route('login')}}">Book Now</a>
              @endif
              @if (Auth::user()->role === 'restaurant_manager')
                <a class="text-white mr-4" href="{{ route('manager.restaurant.index') }}">Your Restaurant</a>
              @endif
              @if (Auth::user()->role === 'band_manager')
                <a class="text-white mr-4" href="#">Your Band</a>
              @endif
                <a class="text-white" href="{{route('profile.edit')}}">{{Auth::user()->name}}</a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="text-white ml-2">Logout</button>
                </form>
            </div>
            </div>
        @else
            <div>
                <div>
                    <a class="text-white" href="{{route('login')}}">Login</a>
                    <a class="text-white" href="{{route('register')}}">Register</a>
                    <a class="text-white ml-3 p-2 bg-gray-900 rounded-full" href="{{route('login')}}">Book Now</a>
                </div>
            </div>
        @endif