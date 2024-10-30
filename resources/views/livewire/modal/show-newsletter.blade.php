<div>
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
                                <div>Newsletters
                                    <div class="page-title-subheading">Découvrir nos dernières publications et mises à jour
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
                                        <h1 class="mb-0" style="font-size: 15px">Pour être prevenu de nos dernières actualités , <a href="{{'login'}}" class="text-primary">abonnez-vous à notre newsletters</a></h1>
                                        @endauth
                                        <hr>
                                    </div>
                                </div>
                                <div class="bg-white">
                                    <div class="table-responsive p-2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="search" wire:model="search" class="form-control" placeholder="Recherche par titre...">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i class="fa fa-business-time fa-w-20"></i>
                                                        </span>
                                                        Trier par
                                                    </button>
                                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" style="width: 50px !important">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-new">
                                                                <a href="javascript:void(0);" class="nav-link" onclick="@this.rangeByDate()">
                                                                    <i class="fa-solid fa-clock mr-2"></i>
                                                                    <span>
                                                                        Date
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <!-- <li class="nav-new">
                                                                <a href="javascript:void(0);" class="nav-link" onclick="@this.rangeByLike()">
                                                                    <i class="fa-solid fa-thumbs-up mr-2"></i>
                                                                    <span>
                                                                        Plus de like
                                                                    </span>
                                                                </a>
                                                            </li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if($results_news->first() != null)
                                                @foreach($results_news as $new)
                                                <div class="container">
                                                    <div class="card mb-3" style="width: 100%;">
                                                        <div class="row no-gutters">
                                                            @if($new->image_link != null)
                                                            <div class="col-md-6">
                                                                <img src="{{asset('storage/'.$new->image_link)}}" alt="...">
                                                            </div>
                                                            @else
                                                            <div class="col-md-6">
                                                                <img src="{{asset('images/default.jpg')}}" alt="...">
                                                            </div>
                                                            @endif($new->image_link == null)
                                                            <div class="col-md-6">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">{{$new->title}}</h4>
                                                                    <p class="card-text text-justify">{{$new->description}}</p>
                                                                    <p class="card-text"><small class="text-muted">{{date("d/m/Y à H:i:s", strtotime($new->updated_at))}}</small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
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