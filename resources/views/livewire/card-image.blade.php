<x-guest-layout>
  @if($user)
    <div id="businesscard" class='flex flex-col justify-center items-center min-h-screen from-gray-700 via-gray-800 to-gray-900 bg-gradient-to-br'>
      <div  class="w-full">
        <div class="relative w-full max-w-md min-w-0 mx-auto mt-6 mb-6 break-words bg-white border shadow-2xl dark:bg-gray-800 dark:border-gray-700 md:max-w-sm rounded-xl">
          <div class="pb-6">
            <div class="flex flex-wrap justify-center">
              <div class="flex justify-center w-full">
                <div class="bg-cover bg-center w-36 h-36 dark:shadow-xl border-white dark:border-gray-800 rounded-full align-middle border-8 absolute -m-16 -ml-18 lg:-ml-16 max-w-[150px]"
                style="background-image: url('{{ asset($user->profile_photo_path) }}');">
                </div>
              </div>
            </div>
            <div class="mt-20 text-center">
                <h3 class="mb-1 text-2xl font-bold leading-normal text-gray-700 dark:text-gray-300">{{ $user->name }}</h3>
                <div class="flex flex-row justify-center w-full mx-auto space-x-2 text-center">
                  <div class="font-bold tracking-wide text-gray-600 dark:text-gray-300 font-mono text-xl">{{ $user->email}}</div>
                </div>
                <div class="w-full text-center">
                  <div class="flex justify-center pt-8 pb-0 lg:pt-4">
                    <div class="flex space-x-2">
                      @if ($user->github_url)
                                            
                        <a class="p-1 -m-1 text-gray-400 hover:text-amber-500 focus:outline-none focus-visible:ring-2 ring-primary" href="{{ $user->github_url }}" rel="noopener" aria-label="Ariel Cerda on Github" target="_blank">
                            <svg class="w-6 h-6 overflow-visible fill-current" alt="" aria-hidden="true" viewBox="0 0 140 140">
                                <path
                                    d="M70 1.633a70 70 0 00-21.7 136.559h1.692a5.833 5.833 0 006.183-6.184v-1.225-6.358a2.917 2.917 0 00-1.167-1.925 2.917 2.917 0 00-2.45-.583C36.925 125.3 33.6 115.5 33.367 114.858a27.067 27.067 0 00-10.034-12.775 6.767 6.767 0 00-.875-.641 3.675 3.675 0 012.217-.409 8.575 8.575 0 016.708 5.134 17.5 17.5 0 0023.334 6.766 2.917 2.917 0 001.691-2.1 11.667 11.667 0 013.267-7.175 2.917 2.917 0 00-1.575-5.075c-13.825-1.575-27.942-6.416-27.942-30.275a23.333 23.333 0 016.125-16.216A2.917 2.917 0 0036.808 49a20.533 20.533 0 01.059-14 32.317 32.317 0 0114.7 6.708 2.858 2.858 0 002.45.409A61.892 61.892 0 0170 39.958a61.075 61.075 0 0116.042 2.159 2.858 2.858 0 002.391-.409 32.608 32.608 0 0114.7-6.708 20.825 20.825 0 010 13.883 2.917 2.917 0 00.525 3.092 23.333 23.333 0 016.125 16.042c0 23.858-14.175 28.641-28.058 30.216a2.917 2.917 0 00-1.575 5.134 12.833 12.833 0 013.558 10.15v18.55a6.183 6.183 0 002.1 4.841 7 7 0 006.184 1.109A70 70 0 0070 1.633z"
                                ></path>
                            </svg>
                        </a>
                      @endif

                      @if ($user->linkedin_url)
                      
                        <a class="p-1 -m-1 text-gray-400 hover:text-amber-500 focus:outline-none focus-visible:ring-2 ring-primary"
                            href="{{ $user->linkedin_url }}"
                            rel="noopener"
                            aria-label="Ariel Cerda on Linkedin"
                            target="_blank">
                            <svg class="w-6 h-6 overflow-visible fill-current" alt="" aria-hidden="true" viewBox="0 0 140 140">
                                <path
                                    d="M23.4 44.59h-4.75a12.76 12.76 0 00-9.73 2.19 9.44 9.44 0 00-2.35 7.12V131a9.08 9.08 0 002.3 7 9.24 9.24 0 006.82 2c2.22 0 4.15-.21 8.24-.06a12 12 0 009.25-2 9.1 9.1 0 002.29-7V53.9a9.44 9.44 0 00-2.34-7.12 12.68 12.68 0 00-9.73-2.19zM21 0A16.19 16.19 0 005.09 15.6 16.52 16.52 0 0021 31.86 16.12 16.12 0 0037 15.6 16.18 16.18 0 0021 0zM99.74 43.63a31.09 31.09 0 00-20.93 6.3A7.25 7.25 0 0077 46.34a6.08 6.08 0 00-4.52-1.78 119.08 119.08 0 00-15 .3c-4.16.84-6.18 3.79-6.18 9V131a9.14 9.14 0 002.28 7 12.06 12.06 0 009.26 2c4.47-.17 5.74.06 8.22.06a9.26 9.26 0 006.83-2 9.12 9.12 0 002.3-7V89.88A12.48 12.48 0 0192.93 76 12.44 12.44 0 01106 89.88V131a9.1 9.1 0 002.29 7 12 12 0 009.24 2c1.83-.07 4-.07 5.8 0a12.09 12.09 0 009.26-2 9.14 9.14 0 002.28-7V78.32a33.07 33.07 0 00-35.13-34.69z"
                                ></path>
                            </svg>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
            </div>
            <div class="pt-6 mx-6 mt-6 text-center border-t border-gray-200 dark:border-gray-700/50">
                <div class="flex flex-wrap justify-center">
                    <div class="bg-cover bg-center w-48 h-48" style="background-image: url('{{ asset('img/qrcodes/' . $user->user_name . '.png') }}');"></div>
                </div>
            </div>
            <div class="relative h-6 overflow-hidden translate-y-6 rounded-b-xl">
              <div class="absolute flex -space-x-12 rounded-b-2xl">
                <div class="w-36 h-8 transition-colors duration-200 delay-75 transform skew-x-[35deg] bg-amber-400/90 group-hover:bg-amber-600/90 z-10"></div>
                <div class="w-28 h-8 transition-colors duration-200 delay-100 transform skew-x-[35deg] bg-amber-300/90 group-hover:bg-amber-500/90 z-20"></div>
                <div class="w-28 h-8 transition-colors duration-200 delay-150 transform skew-x-[35deg] bg-amber-200/90 group-hover:bg-amber-400/90 z-30"></div>
                <div class="w-28 h-8 transition-colors duration-200 delay-200 transform skew-x-[35deg] bg-amber-100/90 group-hover:bg-amber-300/90 z-40"></div>
                <div class="w-28 h-8 transition-colors duration-200 delay-300 transform skew-x-[35deg] bg-amber-50/90 group-hover:bg-amber-200/90 z-50"></div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div class="flex flex-col justify-center items-center shrink-0 w-full">
        <button
          onclick="takeScreenshot()"
          data-html2canvas-ignore="true"
          class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded-full outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
          type="button">Download Business Card</button>
        </div>
      </div>

  @else

    @livewire('no-buz-card', [
      'title' => 'Nenhum cartão de visita foi encontrado com o link acima.',
      'code' => '404',
    ])
  @endif
</x-guest-layout>

