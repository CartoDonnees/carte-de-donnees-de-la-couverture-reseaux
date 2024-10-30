<div>
    {{-- Be like water. --}}
    <?php

    use App\Models\User;
    use App\Models\Answer;
    ?>
    <div class="scroll-area-lg">
        <div class="scrollbar-container ps--active-y">
            <div class="app-inner-layout">
                <div class="app-inner-layout__header bg_mdprimary">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading text-white">
                                <div class="page-title-icon">
                                    <i class="far fa-newspaper text-success"></i>
                                </div>
                                <div>Mises à jours
                                    <div class="page-title-subheading">Découvrir les dernières mises à jours du réseau mobile de Côte d'Ivoire
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" data-original-title="Example Tooltip">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-inner-layout__wrapper">
                    <div class="app-inner-layout__content card">
                        <div class="row">
                            <div class="col-md-12">
                                @if(!$selected)
                                <div class="app-inner-layout__top-pane bg-secondary text-white">
                                    <div class="pane-left">
                                        @auth
                                        <h1 class="mb-0" style="font-size: 15px">Abonné, vous êtes prevenu de nos dernières actualités et mises à jours.
                                            @else
                                            <h1 class="mb-0" style="font-size: 15px">Pour être prevenu de nos dernières mises à jours , <a href="{{'login'}}" class="text-primary">abonnez-vous à notre newsletters</a></h1>
                                            @endauth
                                            <hr>
                                    </div>
                                </div>
                                <div class="bg-white">
                                    <div class="table-responsive p-2">
                                        <div class="container">
                                            <div class="row">
                                                @if($results_news->first() != null)
                                                @foreach($results_news as $new)
                                                <div class="container mt-4">
                                                    <div class="card mb-3" style="width: 100%;">
                                                        <div class="row no-gutters">
                                                            @if($new->technologie == "2G")
                                                            <div class="col-md-6">
                                                                <img src="{{asset('images/2G.jpg')}}" alt="...">
                                                            </div>
                                                            @elseif ($new->technologie == "3G")
                                                            <div class="col-md-6">
                                                                <img src="{{asset('images/3G.jpg')}}" alt="...">
                                                            </div>
                                                            @elseif ($new->technologie == "4G")
                                                            <div class="col-md-6">
                                                                <img src="{{asset('images/4G.jpg')}}" alt="...">
                                                            </div>
                                                            @endif
                                                            <div class="col-md-6">
                                                                <div class="card-body">
                                                                    @if ($new->couverture == 1)
                                                                    <h4 class="card-title">Ajout de la couverture {{ $new->technologie}} à {{ $new->localite}}</h4>
                                                                    <p class="card-text text-justify">La localité {{ $new->localite}} est maintenant couverte en {{$new->technologie}} par l'opérateur {{ $new->operateur}}</p>
                                                                    <p class="card-text"><small class="text-muted">{{date("d/m/Y à H:i:s", strtotime($new->updated_at))}}</small></p>

                                                                    @else
                                                                    <h4 class="card-title">Retrait de la couverture {{ $new->technologie}} à {{ $new->localite}}</h4>
                                                                    <p class="card-text text-justify">La localité {{ $new->localite}} est n'est plus couverte en {{$new->technologie}} par l'opérateur {{ $new->operateur}}</p>
                                                                    <p class="card-text"><small class="text-muted">{{date("d/m/Y à H:i:s", strtotime($new->updated_at))}}</small></p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="container mt-4">
                                                    <div class="bg-light p-4 mb-3 rounded" style="width: 100%;">
                                                        <div class="d-flex justify-content-center">
                                                            <img src="{{asset('/images/empty.png')}}" style="height:280px; "
                                                        </div>
                                                    </div>
                                                    <h2 class="text-center" style="font-size: 35px">Aucune mise à jour disponible !</h2>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else

                                <div class="app-inner-layout__top-pane bg-success text-white mb-4">
                                    <div class="">
                                        <h1 class="mb-0" style="font-size: 15px; text-align:center">Lecture de
                                            newsletters <small>Pour mieux aprecier une newsletter, cliquez sur
                                                l'icon oeil</small></h1>
                                        <hr>
                                    </div>
                                </div>
                                <div class="p-2">

                                    <h4 style="font-size: 12px"><b>Titre:</b> {{ $s_new->title }} <a href="javascript:void()" class="float-right btn btn-dark pb-1" style="position: relative" onclick="@this.set('selected',false)">Retour</a>
                                    </h4>
                                    <div class="divider"></div>
                                    {{ $s_new->description }}
                                    <div class="divider"></div>
                                    @if($s_new->image_link != null)
                                    <div class="d-flex justify-center">
                                        <iframe src="storage/{{ $s_new->image_link }}" width="900" height="300" frameborder="0"></iframe>
                                    </div>
                                    @endif
                                    <div class="divider"></div>
                                    @if($s_new->file_link != null)
                                    <div class="d-flex justify-center">
                                        <iframe src="storage/{{ $s_new->file_link }}" width="900" height="544" frameborder="0"></iframe>
                                    </div>
                                    @endif
                                    <div class="divider"></div>
                                    @if($s_new->video_link != null)
                                    <div class="d-flex justify-center">
                                        <iframe src="storage/{{ $s_new->video_link }}" width="900" height="544" frameborder="0"></iframe>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>