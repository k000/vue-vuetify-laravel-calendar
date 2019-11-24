@extends('layouts.app')
@section('content')
<div class="container">
    <a href="{{ route("twitter.login") }}" class="btn btn-primary">Twitterでログイン</a>
    <p>
        ログインにはtwitterの認証機能を使用しています。<br />
        特別な入力や操作は必要ありません。<br />
        twitterのアカウントさえあれば、今すぐ最強のノートを始める事ができます。
    </p>
</div>
@endsection
