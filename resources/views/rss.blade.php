@php echo '<?xml version="1.0" encoding="UTF-8"?>' @endphp
<rss version="2.0">
    <channel>
        <title>{{ config('app.name') }}</title>
        <description>Couverture du réseau mobile ivoirien</description>
        @if ($courses->first() != null)
        <lastBuildDate>{{date("d/m/Y à H:i:s", strtotime($courses->first()->updated_at))}}</lastBuildDate>
        @foreach ($courses as $course)
        <item>
            @if ($course->couverture == 1)
            <title>Ajout de la couverture {{ $course->technologie}} à {{ $course->localite}}</title>
            <description>La localité {{ $course->localite}} est maintenant couverte en {{$course->technologie}} par l'opérateur {{ $course->operateur}}</description>
            <pubDate>{{date("d/m/Y à H:i:s", strtotime($course->updated_at))}}</pubDate>
            @else
            <title>Retrait de la couverture {{ $course->technologie}} à {{ $course->localite}}</title>
            <description>La localité {{ $course->localite}} est n'est plus couverte en {{$course->technologie}} par l'opérateur {{ $course->operateur}}</description>
            <pubDate>{{date("d/m/Y à H:i:s", strtotime($course->updated_at))}}</pubDate>
            @endif
        </item>
        @endforeach
        @endif
    </channel>
</rss>