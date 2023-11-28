<x-layouts.mobile.default>
    @section('title', __('general.contact'))

    <div class="flex flex-col gap-4 text-justify">
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-xl font-bold">{{ __('general.contact') }}</h1>
        </div>

        <p class="py-4 border-b">
            مرحبًا بك في صفحة "تواصل معنا" لتطبيق "حديث". نقدر اهتمامك ونحن هنا لتقديم الدعم والإجابة على استفساراتك. يُرجى مراعاة أن المالك ليس مؤسسة، بل هو فرد ملتزم بتقديم خدمة تواصل فعّالة وفعّالة.
        </p>
        <h2 class="text-xl font-bold">
            كيفية التواصل معنا
        </h2>

        <h3 class="text-lg font-semibold">
            البريد الإلكتروني
        </h3>
        <p>
            يُمكنكم التواصل مع المالك مباشرة عبر البريد الإلكتروني. يرجى إرسال استفساراتكم أو مقترحاتكم إلى
            <span class="font-bold">
                contact[at]hadith.app
            </span>
        </p>

        <h3 class="text-lg font-semibold">
            نموذج الاتصال
        </h3>
        <p>
            يوفر نموذج الاتصال على صفحتنا واجهة سهلة لتقديم استفساراتكم أو تقديم ملاحظاتكم. يرجى ملء النموذج بدقة وسنعمل على الرد في أقرب وقت ممكن.
        </p>

        <div class="">
            <form dir="ltr" action="{{ route('mobile.postContact') }}" method="post" class="my-4">
                @csrf

                <div class="flex flex-col items-center justify-between gap-4">
                    <div class="flex flex-col gap-y-2 w-full">
                        <label for="email" class="">{{ __('general.email') }}</label>
                        <div class="flex w-full">
                            <input
                                required
                                name="email"
                                id="email"
                                type="email"
                                @if(auth()->check()) value="{{ auth()->user()->email }}" readonly @endif
                                placeholder="your@gmail.com"
                                autocomplete="email"
                                class="bg-shade h-12 px-2 border border-gray-300 @error('email') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                        </div>
                        @error('email')
                        <small id="emailHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col items-center justify-between gap-4">
                    <div class="flex flex-col gap-y-2 w-full">
                        <label for="subject" class="">{{ __('general.subject') }}</label>
                        <div class="flex w-full">
                            <input
                                name="subject"
                                required
                                id="subject"
                                type="text"
{{--                                placeholder="your@gmail.com"--}}
                                autocomplete="subject"
                                class="bg-shade h-12 px-2 border border-gray-300 @error('subject') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                        </div>
                        @error('subject')
                        <small id="subjectHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col items-center justify-between gap-4">
                    <div class="flex flex-col gap-y-2 w-full">
                        <label for="message" class="">{{ __('general.message') }}</label>
                        <div class="flex w-full">
                            <textarea
                                name="message"
                                required
                                id="message"
                                rows="5"
                                class="bg-shade px-2 border border-gray-300 @error('message') border-red-300 @enderror text-gray-90 rounded-md w-full" ></textarea>
                        </div>
                        @error('message')
                        <small id="messageHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.send') }}</button>

            </form>

        </div>

{{--        <h3 class="text-lg font-semibold">--}}
{{--            وسائل التواصل الاجتماعي--}}
{{--        </h3>--}}
{{--        <p>--}}
{{--            نحن متواجدون على وسائل التواصل الاجتماعي. تابعونا على [حسابات التواصل الاجتماعي] للحصول على التحديثات الأخيرة والتواصل المباشر.--}}
{{--        </p>--}}

        <h2 class="text-lg font-semibold">
            الملاحظات والاقتراحات:
        </h2>
        <p>
            نحن نقدّر آراء المستخدمين ونرحب بأي ملاحظات أو اقتراحات قد تكون لديكم. يرجى إرسالها إلينا لنتمكن من تحسين تجربتكم مع التطبيق.
        </p>

        <h2 class="text-lg font-semibold">
            الالتزام
        </h2>

        <p>
            نحن نلتزم بتقديم خدمة عالية الجودة والتجاوب السريع. نحن نقدر ثقتكم بنا كمالك للتطبيق، ونعدكم بمواصلة العمل على تحسين تجربتكم وتلبية توقعاتكم.

        </p>

        <p>
            شكرًا لاهتمامكم بتطبيق "حديث". نحن هنا لخدمتكم والاستماع إلى ملاحظاتكم واقتراحاتكم.
        </p>

    </div>



</x-layouts.mobile.default>
