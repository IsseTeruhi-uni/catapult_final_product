<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
      {{ __('Show User Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
          <div class="mb-6">
            <div class="flex items-center mb-4">
              <div class="mr-3">
                <img id="preview3" src="{{ isset($user->profile_photo_path) ?  $user->profile_photo_path :  'https://res.cloudinary.com/hanheyrpa/image/upload/f_auto,q_auto/lp7cl1lwezs5vgkgzrlt' }}" alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200" style="width: 45px; height: 45px;">
              </div>
              <!--追加-->
              <a href="{{ route('follow.show1', $user->id) }}" class="mr-3">
                <div style="margin-left: 1cm;">
                  <div class="flex flex-col">
                    <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">{{$followers->count()}} フォロワー</p>
                  </div>
                </div>
              </a>
              <a href="{{ route('follow.show2', $user->id) }}" class="mr-3">
                <div style="margin-left: 1cm;">
                  <div class="flex flex-col">
                    <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">{{$followings->count()}} フォロー</p>
                  </div>
                </div>
              </a>
              <!--ここまで-->
              <!-- follow/unfollow ボタン -->
              <div style="margin-left: 1cm;">
                <div class="flex items-center mr-4">
                  @if ($user->id !== Auth::user()->id)
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
                  @endif
                </div>
              </div>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Name</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="name">
                {{$user->name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">company</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="company">
                {{$company->name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">group</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="group">
                {{$group->name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">post</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="post">
                {{$post->name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">description</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$user->description}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Skills</p>
              @foreach($skills as $skill)
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="skills{{$loop->index}}">
                {{$skill->name}}
              </p>
              @endforeach
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Hobbies</p>
              @foreach($hobbies as $hobby)
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="hobbies{{$loop->index}}">
                {{$hobby->name}}
              </p>
              @endforeach
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Joined_at</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="created_at">
                {{$user->created_at}}
              </p>
            </div>


            <div class="flex items-center justify-end mt-4">
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                  </x-primary-button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>