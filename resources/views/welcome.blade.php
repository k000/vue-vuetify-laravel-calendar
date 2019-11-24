<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            img{
                width:50%;
                height:auto;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/top') }}">MyPage</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    究極の筋トレ
                </div>

                <p>
                    筋トレの記録はオンラインで簡単に記録。
                    <br />
                    見やすいカレンダー形式で、最強の筋トレ記録をつけよう
                </p>

                <p>
                    ログインはtwitter認証なので安心です。<br />
                    メールアドレスを入力する必要はありません。
                    <br />
                    twitterアカウントさえあれば、今すぐ最強のノートを始めることができます
                </p>



            </div>
        </div>
        <div class="content">
            
            <h3>
                見やすいカレンダー
            </h3>
            
            <img alt="ヘルプ" src="{{ asset('/imgs/img1.png') }}">
            <p>
                カレンダー形式で表示されるので、いつどのトレーニングをしたか一目でわかるようになっています。
            </p>
            
            <h3>
                見やすいレイアウト
            </h3>
            <img alt="ヘルプ" src="{{ asset('/imgs/img2.png') }}">
            <p>トレーニング記録は見やすいレイアウトで管理されます。
                <br />
                訂正も削除も簡単です
            </p>

            <h3>種目の登録をすることで始めることができます。</h3>
            <img alt="ヘルプ" src="{{ asset('/imgs/img3.png') }}">
                
            <p>
                あなたのトレーニング記録を残す前に、
                まずは種目の登録をしてください。<br />
            </p>
            <p>
                予めトレーニングの種目を登録して記録できる状態にしておきます。<br />
                筋トレ記録を残す際には、登録してあるトレーニングメニューから種目を選んで登録します。
            </p>


        </div>
    </body>
</html>
