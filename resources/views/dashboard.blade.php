<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

            <div class="custom-section">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="flex items-center">
                            <div class="h-13 w-13 bg-gray-50 dark:bg-red-800/20 flex items-center justify-center rounded-lg" style="width: 2.5rem; height: 2.5rem; border: 2px solid #000000;">
                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#000000">
                                    <defs>
                                        <style>
                                            .cls-6374f8d9b67f094e4896c626-1 {
                                                fill: none;
                                                stroke: currentColor;
                                                stroke-miterlimit: 10;
                                            }
                                        </style>
                                    </defs>
                                    <circle class="cls-6374f8d9b67f094e4896c626-1" cx="9.61" cy="5.8" r="4.3"></circle>
                                    <path class="cls-6374f8d9b67f094e4896c626-1" d="M1.5,19.64l.7-3.47a7.56,7.56,0,0,1,7.41-6.08,7.48,7.48,0,0,1,4.6,1.57"></path>
                                    <circle class="cls-6374f8d9b67f094e4896c626-1" cx="16.77" cy="16.77" r="5.73"></circle>
                                    <polyline class="cls-6374f8d9b67f094e4896c626-1" points="19.64 14.86 16.3 18.2 14.39 16.3"></polyline>
                                </svg>
                            </div>

                            <h2 class="mt-0 ml-4 text-xl font-semibold text-gray-900 dark:text-white">人物関連</h2>
                        </div>
                        <div class="mt-4">
                            @if ($recentlyViewedUsers->count() > 0)
                            <div style="height: 300px; overflow-y: auto; border-radius: 10px;">
                                <table class="text-center w-full border-collapse" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark bg-white">recently Viewed Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentlyViewedUsers as $userHistory)
                                        <tr class="hover:bg-gray-lighter">
                                            <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                                                <div class="flex items-center justify-center">
                                                    <div class="mr-3">
                                                        <img id="preview2" src="{{ isset($userHistory->viewedUser->profile_photo_path) ?  $userHistory->viewedUser->profile_photo_path :  'https://res.cloudinary.com/hanheyrpa/image/upload/f_auto,q_auto/lp7cl1lwezs5vgkgzrlt' }}" alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200" style="width: 45px; height: 45px;">
                                                    </div>
                                                    <a href="{{ route('employees.show', $userHistory->viewedUser->id) }}" class="text-left text-gray-dark dark:text-gray-200">{{$userHistory->viewedUser->name}}</a>

                                                    <div class="flex-grow"></div> <!-- 追加 -->
                                                    <div class="flex items-center ml-3"> <!-- 修正 -->
                                                        <a href="{{ route('employees.show', $userHistory->viewedUser->id) }}" class="mr-3">
                                                            <x-secondary-button>
                                                                {{ __('Show') }}
                                                            </x-secondary-button>
                                                        </a>
                                                        <!--  ここから編集 -->
                                                        <!-- follow/unfollow ボタン -->
                                                        @if(Auth::user()->followings()->where('users.id', $userHistory->viewedUser->id)->exists())
                                                        <!-- unfollow ボタン -->
                                                        <form action="{{ route('unfollow', $userHistory->viewedUser) }}" method="POST">
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

                                                            </x-primary-button>
                                                        </form>
                                                        @else
                                                        <!-- follow ボタン -->
                                                        <form action="{{ route('follow', $userHistory->viewedUser) }}" method="POST">
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

                                                            </x-primary-button>
                                                        </form>
                                                        @endif
                                                        <!-- 🔼 ここまで編集 -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-gray-700 dark:text-gray-300">最近の閲覧履歴はありません。</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-section">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="flex items-center">
                            <div class="h-13 w-13 bg-gray-50 dark:bg-red-800/20 flex items-center justify-center rounded-lg" style="width: 2.5rem; height: 2.5rem; border: 2px solid #000000;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#000000">
                                    <defs>
                                        <style>
                                            .cls-6375f1aeb67f094e4896c9ea-1,
                                            .cls-6375f1aeb67f094e4896c9ea-2 {
                                                fill: none;
                                                stroke: currentColor;
                                                stroke-miterlimit: 10;
                                            }

                                            .cls-6375f1aeb67f094e4896c9ea-1 {
                                                stroke-linecap: square;
                                            }
                                        </style>
                                    </defs>
                                    <g id="calendar">
                                        <rect class="cls-6375f1aeb67f094e4896c9ea-1" x="1.5" y="2.43" width="21" height="4.77" transform="translate(24 9.64) rotate(180)"></rect>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="17.73" y1="0.52" x2="17.73" y2="4.34"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="6.27" y1="0.52" x2="6.27" y2="4.34"></line>
                                        <polygon class="cls-6375f1aeb67f094e4896c9ea-1" points="22.5 11.98 22.5 7.21 1.5 7.21 1.5 22.48 22.5 22.48 22.5 15.79 22.5 11.98"></polygon>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="9.14" y1="11.02" x2="11.05" y2="11.02"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="12.95" y1="11.02" x2="14.86" y2="11.02"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="16.77" y1="11.02" x2="18.68" y2="11.02"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="9.14" y1="14.84" x2="11.05" y2="14.84"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="5.32" y1="14.84" x2="7.23" y2="14.84"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="12.95" y1="14.84" x2="14.86" y2="14.84"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="16.77" y1="14.84" x2="18.68" y2="14.84"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="9.14" y1="18.66" x2="11.05" y2="18.66"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="5.32" y1="18.66" x2="7.23" y2="18.66"></line>
                                        <line class="cls-6375f1aeb67f094e4896c9ea-2" x1="12.95" y1="18.66" x2="14.86" y2="18.66"></line>
                                    </g>
                                </svg>
                            </div>

                            <h2 class="mt-0 ml-4 text-xl font-semibold text-gray-900 dark:text-white">イベント</h2>
                        </div>
                        <div style="height: 300px; overflow-y: auto; border-radius: 10px;">
                            <table class="text-center w-full border-collapse" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark bg-white">Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetings as $meeting)
                                    @php
                                    $attendance = $meeting->attendances()->where('user_id', auth()->id())->first();
                                    @endphp
                                    @if ($attendance)
                                    <tr class="hover:bg-gray-lighter">
                                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600" style="background-color: white; word-wrap: break-word;">
                                            <div class="flex">

                                                <p class="text-gray-dark dark:text-gray-200">{{ $meeting->updated_at }}</p>

                                            </div>
                                            <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;"><a href="{{ route('meeting_attendance.edit', $meeting->id) }}">イベント<span class="font-semibold">{{ $meeting->name }}</span></a>に招待されました</h3>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="custom-section">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class=" flex items-center">
                            <div class="h-13 w-13 bg-gray-50 dark:bg-red-800/20 flex items-center justify-center rounded-lg" style="width: 2.5rem; height: 2.5rem; border: 2px solid #000000;">
                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="24" height="24" color="#000000">
                                    <defs>
                                        <style>
                                            .cls-6376396cc3a86d32eae6f0f6-1 {
                                                fill: none;
                                                stroke: currentColor;
                                                stroke-miterlimit: 10;
                                            }
                                        </style>
                                    </defs>
                                    <path class="cls-6376396cc3a86d32eae6f0f6-1" d="M22.5,8.18V20.59a1.92,1.92,0,0,1-1.91,1.91,1.93,1.93,0,0,1-1.91-1.91V8.18Z"></path>
                                    <path class="cls-6376396cc3a86d32eae6f0f6-1" d="M20.59,22.5H3.41A1.9,1.9,0,0,1,1.5,20.59V1.5H18.68V20.59a1.93,1.93,0,0,0,1.91,1.91Z"></path>
                                    <rect class="cls-6376396cc3a86d32eae6f0f6-1" x="5.32" y="5.32" width="9.55" height="5.73"></rect>
                                    <line class="cls-6376396cc3a86d32eae6f0f6-1" x1="4.36" y1="14.86" x2="15.82" y2="14.86"></line>
                                    <line class="cls-6376396cc3a86d32eae6f0f6-1" x1="4.36" y1="18.68" x2="15.82" y2="18.68"></line>
                                </svg>
                            </div>

                            <h2 class="mt-0 ml-4 text-xl font-semibold text-gray-900 dark:text-white">会社からのお知らせ</h2>
                        </div>
                        <div style="height: 300px; overflow-y: auto; border-radius: 10px;">
                            <table class="text-center w-full border-collapse" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark bg-white">Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                    <tr class="hover:bg-gray-lighter">
                                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600" style="background-color: white; word-wrap: break-word;">
                                            <div class="flex">
                                                <!-- 🔽 編集 -->
                                                <p class="text-gray-dark dark:text-gray-200 font-semibold">{{$blog->tweet}}</p>
                                                <div style="margin-left: 1cm;">
                                                    <p class="text-gray-dark dark:text-gray-200">{{ $blog->updated_at }}</p>
                                                    <!-- 🔼 ここまで -->
                                                </div>
                                            </div>
                                            <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;">{{$blog->description}}</h3>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-section">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="flex items-center">
                            <div class="h-13 w-13 bg-gray-50 dark:bg-red-800/20 flex items-center justify-center rounded-lg" style="width: 2.5rem; height: 2.5rem; border: 2px solid #000000;">
                                <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" viewBox="0 0 22.91 22.91" width="24" height="24" color="#000000">
                                    <g id="star-badge-award" transform="translate(-0.545 -0.545)">
                                        <path id="Path_32" data-name="Path 32" d="M18.68,12a6.63,6.63,0,1,1-1.942-4.738A6.68,6.68,0,0,1,18.68,12Z" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10"></path>
                                        <path id="Path_33" data-name="Path 33" d="M22.5,12c0,.9-1.1,1.64-1.32,2.46s.35,2.05-.08,2.79-1.77.85-2.38,1.47-.71,1.94-1.47,2.37-1.94-.14-2.79.09S12.89,22.5,12,22.5s-1.63-1.1-2.46-1.32-2,.35-2.79-.09-.85-1.76-1.47-2.37S3.34,18,2.9,17.25s.15-1.93-.08-2.79S1.5,12.9,1.5,12s1.1-1.64,1.32-2.46-.35-2,.08-2.79S4.66,5.9,5.28,5.28,6,3.34,6.75,2.9s1.93.15,2.79-.08S11.1,1.5,12,1.5s1.64,1.1,2.46,1.32,2-.35,2.79.08.85,1.76,1.47,2.38S20.66,6,21.1,6.75s-.15,1.93.08,2.79S22.5,11.1,22.5,12Z" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10"></path>
                                        <path id="Path_34" data-name="Path 34" d="M12,7.92l1.18,2.46,2.64.4L13.91,12.7l.45,2.71L12,14.13,9.64,15.41l.45-2.71L8.18,10.78l2.64-.4Z" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                            <h2 class="mt-0 ml-4 text-xl font-semibold text-gray-900 dark:text-white">アクティビティ</h2>
                        </div>
                        <div style="height: 300px; overflow-y: auto; border-radius: 10px;">
                            <table class="text-center w-full border-collapse" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark bg-white">activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    @if ($item->user_id == auth()->user()->id)
                                    <tr class="hover:bg-gray-lighter">
                                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600" style="background-color: white; word-wrap: break-word;">
                                            <div class="flex">

                                                <p class="text-gray-dark dark:text-gray-200">{{ $item->updated_at }}</p>

                                            </div>
                                            <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;"><a href="{{ route('employees.show', $item->following_id) }}"><span class="font-semibold">{{ $item->following->name }}</span></a>さんをフォローしました。</h3>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="hover:bg-gray-lighter">
                                        <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600" style="background-color: white; word-wrap: break-word;">
                                            <div class="flex">

                                                <p class="text-gray-dark dark:text-gray-200">{{ $item->updated_at }}</p>

                                            </div>
                                            <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;"><a href="{{ route('employees.show', $item->user_id) }}"><span class="font-semibold">{{$item->user->name}}</span></a>さんにフォローされました。</h3>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>