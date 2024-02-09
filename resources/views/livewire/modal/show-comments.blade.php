<div>
    <?php

    use App\Models\User;
    use App\Models\Answer;
    ?>
    <div class="scroll-area-lg">
        <div class="scrollbar-container ps--active-y">
            <div class="app-inner-layout">
                <div class="app-inner-layout__header text-white bg_mdprimary">
                    <div class="app-page-title">
                        <div class="page-title-wrapper p-2">
                            <div class="page-title-heading" style="height: 25px !important">
                                <div class="page-title-icon">
                                    <i class="fab fa-forumbee mr-2 text-success text-success"></i>
                                </div>
                                <div>Commentaires
                                    <div class="page-title-subheading">Liste des commentaires.</div>
                                </div>
                            </div>

                            <div class="page-title-actions">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-business-time fa-w-20"></i>
                                    </span>
                                    Trier par
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" style="width: 50px !important">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link" onclick="@this.rangeByDate()">
                                                <i class="fa-solid fa-clock mr-2"></i>
                                                <span>
                                                    Date
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link" onclick="@this.rangeByLike()">
                                                <i class="fa-solid fa-thumbs-up mr-2"></i>
                                                <span>
                                                    Plus de like
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="" type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Example Tooltip">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-inner-layout__wrapper row-fluid no-gutters">
                    <div class="app-inner-layout__sidebar bg-transparent card">
                        <div class="p-0">
                            <div class="dropdown-menu nav p-0 dropdown-menu-inline dropdown-menu dropdown-menu-hover-primary app-inner-layout__sidebar card flex-column">
                                <h6 tabindex="-1" class="pt-0 dropdown-header">Menu</h6>
                                <a href="javascript:void()" class="mb-1 dropdown-item {{ $action == 'all' ? 'active' : '' }}" onclick="@this.set('action','all')">Commentaires</a>
                                @auth
                                <a href="javascript:void()" class="mb-1 dropdown-item {{ $action == 'my' ? 'active' : '' }}" onclick="@this.set('action','my')">Mes
                                    commentaires</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 app-inner-layout__content card">
                        <div class="pt-3">
                            <div class="mobile-app-menu-btn mb-3">
                                <button type="button" class="hamburger hamburger--elastic"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
                            </div>
                            <div class="tab-content p-3">
                                @if($action == "all")
                                <div class="row">
                                    <div class="col-md-12">
                                        @auth
                                        @if($success_c)
                                        <div class="alert alert-success fade show" role="alert">Votre commentaire à
                                            été ajouté avec succès</div>
                                        @endif
                                        @if($success_d)
                                        <div class="alert alert-success fade show" role="alert">Votre commentaire à
                                            été supprimé</div>
                                        @endif
                                        <form wire:submit.prevent="submitComment">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Ajouter un commentaire" wire:model.defer="comment"></textarea>
                                                    <button type="submit" class="mt-1 btn btn-primary btn-sm btn-show-swal float-right ">Envoyer</button>
                                                </div>
                                            </div>
                                        </form>
                                        @else
                                        <div class="d-flex justify-center">
                                            <h4>Veuillez vous connecter ou créer un compte pour ajouter des
                                                commentaires
                                            </h4>
                                            <div class="ml-2">

                                                <a href="{{ Route('login') }}" class="btn btn-primary">Se
                                                    connecter</a>
                                                <a href="{{ Route('register') }}" class="btn btn-success">S'inscrire</a>
                                            </div>
                                        </div>
                                        @endauth
                                        <h5 class="mt-2">Tous les commentaires</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-inline-block dropdown">
                                            <div>
                                            </div>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0);" class="nav-link">
                                                            <i class="far fa-clock mr-2"></i>
                                                            <span>
                                                                Récent
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                @if($comments->first() != null)
                                @foreach ($comments as $item)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="media">
                                            <img style="width: 40px; height: auto;" src="{{ User::find($item->user_id)->profile_photo_url }}" alt="" class="d-block ui-w-40 rounded-circle">
                                            <div class="media-body ml-4">
                                                <div class="float-right text-muted small">{{
                                                        User::find($item->user_id)->created_at }}</div>
                                                <a href="javascript:void(0)" href="javascript:void(0)">{{
                                                        User::find($item->user_id)->pseudo
                                                        }}</a>
                                                <div class="text-muted small">Membre depuis {{ $item->created_at }}
                                                </div>
                                                <div class="mt-2">
                                                    {{ $item->comment }}
                                                </div>
                                                <div class="divider"></div>
                                                {{-- <div class="d-none" id="reactions"> --}}
                                                <div class="" id="{{ $item->id.'1' }}">
                                                    @if($shw_all_answ == $item->id)

                                                    @php
                                                    $al_reaction =
                                                    Answer::where('comment_id',$item->id)->where('types','comment')->orderBy('created_at',
                                                    'asc')->get();
                                                    @endphp
                                                    <div>
                                                        @if($al_reaction->first() != null)
                                                        @foreach($al_reaction as $value)

                                                        @auth()
                                                        <div class="chat-box-wrapper offset-md-6 text-right rounded">
                                                            @else
                                                            <div class="chat-box-wrapper">

                                                                @endauth

                                                                <div class=" avatar-icon-wrapper mr-1">
                                                                    <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                                                    </div>
                                                                    <div class="avatar-icon avatar-icon-lg rounded-circle">
                                                                        <img src="{{ User::find($value->from_id)->profile_photo_url }}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="chat-box"><small>{{
                                                                                    $value->answer }}</small>
                                                                    </div>
                                                                    <small class="opacity-6">
                                                                        <i class="fa fa-calendar-alt mr-1"></i>
                                                                        {{ $value->created_at }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                        <h5 class="text-center">Aucune réaction</h5>
                                                        @endif

                                                        @else
                                                        @php
                                                        $reaction =
                                                        Answer::where('comment_id',$item->id)->where('types','comment')->orderBy('created_at',
                                                        'asc')->get()->first();
                                                        @endphp
                                                        <div>
                                                            @if($reaction != null)
                                                            @auth()

                                                            <div class="chat-box"><small>...</small>
                                                                <div class="chat-box-wrapper offset-md-6 text-right rounded">
                                                                    @else
                                                                    <div class="chat-box-wrapper">
                                                                        @endauth

                                                                        <div class=" avatar-icon-wrapper mr-1">
                                                                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg">
                                                                            </div>
                                                                            <div class="avatar-icon avatar-icon-lg rounded-circle">
                                                                                <img src="{{ User::find($reaction->from_id)->profile_photo_url }}" alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="chat-box"><small>{{
                                                                                            $reaction->answer }}</small>
                                                                            </div>
                                                                            <small class="opacity-6">
                                                                                <i class="fa fa-calendar-alt mr-1"></i>
                                                                                {{ $reaction->created_at }}
                                                                            </small>

                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                @endif
                                                            </div>

                                                            @auth()
                                                            <div class="" id="{{ $item->id.'2' }}">
                                                                <div class="app-inner-layout__bottom-pane d-block text-center">
                                                                    <div class="mb-0 position-relative row form-group">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div>
                                                                                @if($shw_all_answ == $item->id)
                                                                                <a href="javascript:void(0)" class="text-warning float-right" id="btmask{{ $item->id }}" onclick="@this.set('shw_all_answ', false)">Masquer
                                                                                    les réactions</a>
                                                                                @else
                                                                                <a href="javascript:void(0)" class="text-info float-right" onclick="@this.set('shw_all_answ',{{ $item->id }})">Voir toutes
                                                                                    les réactions</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="row">
                                                                                <div class="col-md-11">
                                                                                    <form wire:submit.prevent="submitAnswer({{ $item->id }})">
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" wire:model.defer='answ' placeholder="Entrer votre message...">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="input-group-text text-info" type="submit" onclick="document.getElementById({{ $item->id.'1' }}).className = 'd-block'; document.getElementById('btopen').className = 'text-info float-right d-block';">
                                                                                                    <i class="fas fa-paper-plane mr-2"></i>Envoyer
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <button type="button" id="btncan" class="btn-shadow btn" onclick="document.getElementById({{ $item->id.'2' }}).className = 'd-none'; document.getElementById('btnansw').className = 'text-muted ml-3 d-block'">
                                                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                                                            <i class="fas fa-times"></i>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endauth
                                                            {{--
                                                                </div> --}}
                                                            <div class="small mt-2">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            @auth()
                                                                            <div class="col-md-4">
                                                                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Aimez vous ce commentaire ?" class="text-muted d-inline-flex align-items-center align-middle" wire:click="like({{ $item->id }})">
                                                                                    <i class="fas fa-thumbs-up ml-2 mr-2"></i>&nbsp;
                                                                                    <span class="align-middle">{{
                                                                                            $item->likes }}</span>
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            </div>
                                                                            <div class="col-md-4 align-items-center align-middle">
                                                                                <a href="javascript:void(0)" class="text-muted ml-3 d-none" data-toggle="tooltip" data-placement="top" title="Votre avis sur ce commentaire" id="btnansw" onclick="document.getElementById({{ $item->id.'2' }}).className = 'd-block'; this.className='d-none'">
                                                                                    <i class="fas fa-reply mr-2"></i>Répondre</a>
                                                                            </div>
                                                                            @else
                                                                            <div class="col-md-4">
                                                                                <a href="{{ Route('login') }}" data-toggle="tooltip" data-placement="top" title="Aimez vous ce mommentaire ?" class="text-muted d-inline-flex align-items-center align-middle">
                                                                                    <i class="fas fa-thumbs-up ml-2 mr-2"></i>&nbsp;
                                                                                    <span class="align-middle">{{
                                                                                            $item->likes }}</span>
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-md-4 align-items-center align-middle">
                                                                                <a href="{{ Route('login') }}" class="text-muted ml-3" data-toggle="tooltip" data-placement="top" title="Votre avis sur ce commentaire">
                                                                                    <i class="fas fa-reply mr-2"></i>Répondre</a>
                                                                            </div>
                                                                            @endauth
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                </div>
                                                                </a>
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
                                @elseif($action == "my")
                                <h5>Mes commentaires</h5>
                                <div class="divider"></div>
                                @foreach ($my_comments as $item)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="media">
                                            <img style="width: 40px; height: auto;" src="{{ User::find($item->user_id)->profile_photo_url }}" alt="" class="d-block ui-w-40 rounded-circle">
                                            <div class="media-body ml-4">
                                                <div class="float-right text-muted small">{{
                                                    User::find($item->user_id)->created_at }}</div>
                                                <a href="javascript:void(0)">{{
                                                    User::find($item->user_id)->name }}</a>
                                                <div class="text-muted small">Membre depuis {{
                                                    $item->created_at }}</div>
                                                <div class="mt-2">
                                                    {{ $item->comment }}
                                                </div>
                                                <div class="small mt-2">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Nombre de likes" class="text-muted d-inline-flex align-items-center align-middle">
                                                                <i class="fas fa-thumbs-up ml-2 mr-2"></i>&nbsp;
                                                                <span class="align-middle">{{ $item->likes }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle ml-4" data-toggle="tooltip" data-placement="top" title="Votre avis sur ce commentaire">
                                                                <i class="fas fa-reply mr-2"></i>Reponses</a>
                                                        </div>
                                                    </div>
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
            </div>