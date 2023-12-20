<!-- create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('情報登録') }}
        </h2>
    </x-slot>


    <div class="py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="company_id" class="text-gray-700 dark:text-gray-300">会社名:</label>
                            <select name="company_id" id="company_id" class="form-select" required>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>

                            <label for="group_id" class="text-gray-700 dark:text-gray-300">所属部門:</label>
                            <select name="group_id" id="group_id" class="form-select" required>
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>

                            <label for="post_id" class="text-gray-700 dark:text-gray-300">役職:</label>
                            <select name="post_id" id="post_id" class="form-select" required>
                                @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="skills-container">
                            <div class="mb-4">
                                <label class="text-gray-700 dark:text-gray-300">スキル:</label>
                                <!--<legend class="block font-medium text-sm mb-2">スキル</legend>
                            <div class="space-y-2"> -->
                                <!-- <div class="flex items-center">
                                    <input id="C" name="skills[]" type="checkbox" value="1" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="C" class="ml-2">C</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="C#" name="skills[]" type="checkbox" value="2" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="C#" class="ml-2">C#</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="C++" name="skills[]" type="checkbox" value="3" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="C++" class="ml-2">C++</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="Java" name="skills[]" type="checkbox" value="4" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="Java" class="ml-2">Java</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="JavaScript" name="skills[]" type="checkbox" value="5" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="JavaScript" class="ml-2">JavaScript</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="Ruby" name="skills[]" type="checkbox" value="6" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="Ruby" class="ml-2">Ruby</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="Python" name="skills[]" type="checkbox" value="7" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="Python" class="ml-2">Python</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="PHP" name="skills[]" type="checkbox" value="8" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="PHP" class="ml-2">PHP</label>
                                </div> -->
                                <!-- 他のスキルを追加 -->

                                <select name="skills[]" class="form-select" required>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addSkill()" class="add-button">Add+</button>
                            </div>
                        </div>

                        <div id="hobbies-container">
                            <div class="mb-4">
                                <label class="text-gray-700 dark:text-gray-300">趣味:</label>
                                <!--<fieldset class="mb-6">
                            <legend class="block font-medium text-sm mb-2">趣味</legend>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="hobby_1" name="hobbies[]" type="checkbox" value="1" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_1" class="ml-2">映画鑑賞</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_2" name="hobbies[]" type="checkbox" value="2" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_2" class="ml-2">音楽鑑賞</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_3" name="hobbies[]" type="checkbox" value="3" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_3" class="ml-2">キャンプ</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_4" name="hobbies[]" type="checkbox" value="4" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_4" class="ml-2">筋トレ</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_5" name="hobbies[]" type="checkbox" value="5" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_5" class="ml-2">ヨガ</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_6" name="hobbies[]" type="checkbox" value="6" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_6" class="ml-2">ランニング</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_7" name="hobbies[]" type="checkbox" value="7" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_7" class="ml-2">ゲーム</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_8" name="hobbies[]" type="checkbox" value="8" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_8" class="ml-2">旅行</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_9" name="hobbies[]" type="checkbox" value="9" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_9" class="ml-2">読書</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_10" name="hobbies[]" type="checkbox" value="10" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_10" class="ml-2">料理</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_11" name="hobbies[]" type="checkbox" value="11" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_11" class="ml-2">野球観戦</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_12" name="hobbies[]" type="checkbox" value="12" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_12" class="ml-2">釣り</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_13" name="hobbies[]" type="checkbox" value="13" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_13" class="ml-2">麻雀</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_14" name="hobbies[]" type="checkbox" value="14" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_14" class="ml-2">ゴルフ</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="hobby_15" name="hobbies[]" type="checkbox" value="15" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <label for="hobby_15" class="ml-2">カメラ</label>
                                </div>
                            </div>
                        </fieldset> -->

                                <select name="hobbies[]" class="form-select" required>
                                    @foreach($hobbies as $hobby)
                                    <option value="{{ $hobby->id }}">{{ $hobby->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addHobby()" class="add-button">Add+</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <label for="description" class="text-gray-700 dark:text-gray-300">自己紹介文:</label>
                            <input type="text" name="description" id="description" class="form-input h-40" placeholder="自己紹介を入力してください" required>
                        </div>


                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button>
                                {{ __('登録') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addSkill() {
            const container = document.getElementById('skills-container');
            const selects = container.querySelectorAll('select[name="skills[]"]');

            if (selects.length < 3) {
                const newSelect = selects[0].cloneNode(true);

                for (let i = 0; i < selects.length; i++) {
                    const options = newSelect.querySelectorAll('option');
                    const selectedOptions = selects[i].querySelectorAll('option:checked');
                    selectedOptions.forEach(selectedOption => {
                        const selectedValue = selectedOption.getAttribute('value');
                        const removeIndex = Array.from(options).findIndex(option => option.value === selectedValue);
                        if (removeIndex !== -1) {
                            options[removeIndex].remove();
                        }
                    });
                }

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('remove-button'); // remove-buttonクラスを追加
                removeButton.addEventListener('click', function() {
                    container.removeChild(divWrapper);
                });

                const divWrapper = document.createElement('div');
                divWrapper.classList.add('mb-4');
                divWrapper.appendChild(newSelect);
                divWrapper.appendChild(removeButton);

                container.appendChild(divWrapper);
            } else {
                alert('最大3つまでしか追加できません。');
            }
        }

        function addHobby() {
            const container = document.getElementById('hobbies-container');
            const selects = container.querySelectorAll('select[name="hobbies[]"]');

            if (selects.length < 3) {
                const newSelect = selects[0].cloneNode(true);

                for (let i = 0; i < selects.length; i++) {
                    const options = newSelect.querySelectorAll('option');
                    const selectedOptions = selects[i].querySelectorAll('option:checked');
                    selectedOptions.forEach(selectedOption => {
                        const selectedValue = selectedOption.getAttribute('value');
                        const removeIndex = Array.from(options).findIndex(option => option.value === selectedValue);
                        if (removeIndex !== -1) {
                            options[removeIndex].remove();
                        }
                    });
                }

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('remove-button'); // remove-buttonクラスを追加
                removeButton.addEventListener('click', function() {
                    container.removeChild(divWrapper);
                });

                const divWrapper = document.createElement('div');
                divWrapper.classList.add('mb-4');
                divWrapper.appendChild(newSelect);
                divWrapper.appendChild(removeButton);

                container.appendChild(divWrapper);
            } else {
                alert('最大3つまでしか追加できません。');
            }
        }
    </script>

    <style>
        .add-button {
            /* ボタンのスタイル */
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 8px;
            /* ボタン間の余白 */
        }

        .remove-button {
            /* ボタンのスタイル */
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 8px;
            /* ボタン間の余白 */
        }
    </style>

</x-app-layout>