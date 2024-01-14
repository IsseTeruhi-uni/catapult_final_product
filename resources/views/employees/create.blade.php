<!-- create.blade.php -->
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('情報登録') }}
        </h2>
    </x-slot>


    <div class="py-12 flex justify-center">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- 画像選択 -->
                        <div class="mb-4">
                            <x-picture-input />
                            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                        </div>

                        <div class="max-w-7xl mx-auto">
                            <div class="mb-4">
                                <label for="company_id" class="text-gray-700 dark:text-gray-300">会社名:</label>
                                <select name="company_id" id="company_id" class="form-select" required>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="group_id" class="text-gray-700 dark:text-gray-300">所属部門:</label>
                                <select name="group_id" id="group_id" class="form-select" required>
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="post_id" class="text-gray-700 dark:text-gray-300">役職:</label>
                                <select name="post_id" id="post_id" class="form-select" required>
                                    @foreach($posts as $post)
                                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="skills-container" class="mb-4">
                                <label class="text-gray-700 dark:text-gray-300">スキル:</label>
                                <select name="skills[]" class="form-select" required>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addSkill()" class="add-button">Add+</button>
                            </div>

                            <div id="hobbies-container" class="mb-4">
                                <label class="text-gray-700 dark:text-gray-300">趣味:</label>
                                <select name="hobbies[]" class="form-select" required>
                                    @foreach($hobbies as $hobby)
                                    <option value="{{ $hobby->id }}">{{ $hobby->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addHobby()" class="add-button">Add+</button>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="text-gray-700 dark:text-gray-300">自己紹介文:</label>
                                <textarea name="description" id="description" class="form-input h-40 resize-none" placeholder="自己紹介を入力してください" required></textarea>
                            </div>
                        </div>




                        <!-- 登録ボタン -->
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

</x-guest-layout>