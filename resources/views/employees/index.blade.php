<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      {{ __('User Index') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
          @if($users->count()>0)
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">Search Result</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              @if ($user->id !== Auth::user()->id)
              <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                  <div class="flex items-center justify-center">
                    <div class="mr-3">
                      <img id="preview4" src="{{ isset($user->profile_photo_path) ?  $user->profile_photo_path :  'https://res.cloudinary.com/hanheyrpa/image/upload/f_auto,q_auto/lp7cl1lwezs5vgkgzrlt' }}" alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200" style="width: 45px; height: 45px;">
                    </div>
                    <a href="{{ route('employees.show', $user->id) }}" class="text-left text-gray-dark dark:text-gray-200">{{$user->name}}</a>
                    <div class="flex-grow"></div> <!-- 追加 -->
                    <div class="flex items-center ml-3"> <!-- 修正 -->
                      <a href="{{ route('employees.show', $user->id) }}" class="mr-3">
                        <x-secondary-button>
                          {{ __('Show') }}
                        </x-secondary-button>
                      </a>
                      <!--  ここから編集 -->
                      <!-- follow/unfollow ボタン -->
                      @if(Auth::user()->followings()->where('users.id', $user->id)->exists())
                      <!-- unfollow ボタン -->
                      <form action="{{ route('unfollow', $user) }}" method="POST">
                        @csrf
                        <x-primary-button title="フォローをやめる" class="bg-white">
                          <!-- ここにSVGアイコンとフォロワー数を表示 -->
                          <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#808080">
                            <defs>
                              <style>
                                .cls-6374f8d9b67f094e4896c61d-1 {
                                  fill: yellow;
                                  stroke: currentColor;
                                  stroke-miterlimit: 10;
                                }
                              </style>
                            </defs>
                            <circle class="cls-6374f8d9b67f094e4896c61d-1" cx="9.61" cy="5.8" r="4.3"></circle>
                            <path class="cls-6374f8d9b67f094e4896c61d-1" d="M1.5,19.64l.7-3.47a7.56,7.56,0,0,1,7.41-6.08,7.48,7.48,0,0,1,4.6,1.57"></path>
                            <circle class="cls-6374f8d9b67f094e4896c61d-1" cx="16.77" cy="16.77" r="5.73"></circle>
                            <line class="cls-6374f8d9b67f094e4896c61d-1" x1="14.39" y1="14.39" x2="19.16" y2="19.16"></line>
                            <line class="cls-6374f8d9b67f094e4896c61d-1" x1="19.16" y1="14.39" x2="14.39" y2="19.16"></line>
                          </svg>
                          <span style="color: grey;">{{ $user->followers()->count() }}</span>
                        </x-primary-button>
                      </form>
                      @else
                      <!-- follow ボタン -->
                      <form action="{{ route('follow', $user) }}" method="POST">
                        @csrf
                        <x-primary-button title="フォローする" class="bg-white">
                          <!-- ここにSVGアイコンとフォロワー数を表示 -->
                          <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#808080">
                            <defs>
                              <style>
                                .cls-6374f8d9b67f094e4896c60d-1 {
                                  fill: none;
                                  stroke: currentColor;
                                  stroke-miterlimit: 10;
                                }
                              </style>
                            </defs>
                            <circle class="cls-6374f8d9b67f094e4896c60d-1" cx="9.61" cy="5.8" r="4.3"></circle>
                            <path class="cls-6374f8d9b67f094e4896c60d-1" d="M1.5,19.64l.7-3.47a7.56,7.56,0,0,1,7.41-6.08,7.43,7.43,0,0,1,4.59,1.57"></path>
                            <circle class="cls-6374f8d9b67f094e4896c60d-1" cx="16.77" cy="16.77" r="5.73"></circle>
                            <line class="cls-6374f8d9b67f094e4896c60d-1" x1="13.91" y1="16.77" x2="19.64" y2="16.77"></line>
                            <line class="cls-6374f8d9b67f094e4896c60d-1" x1="16.77" y1="13.91" x2="16.77" y2="19.64"></line>
                          </svg>
                          <span style="color: grey;">{{ $user->followers()->count() }}</span>
                        </x-primary-button>
                      </form>
                      @endif
                      <!-- 🔼 ここまで編集 -->
                    </div>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          @else
          <p class="text-gray-700 dark:text-gray-300">ユーザが見つかりませんでした。</p>
          <div class="flex items-center justify-end mt-4">
            <a href="{{ url()->previous() }}">
              <x-secondary-button class="ml-3">
                {{ __('Back') }}
                </x-primary-button>
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>