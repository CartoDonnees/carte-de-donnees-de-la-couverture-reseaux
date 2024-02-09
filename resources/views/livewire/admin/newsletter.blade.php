<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="mb-3 card">
        <div class="card-body">
            <div class="tabs-lg-alternate card-header">
                <ul class="nav nav-justified">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link minimal-tab-btn-1 {{ $action == 'list' ? 'active': '' }}" onclick="@this.set('action','list')">
                            <div class="widget-number"><span>Liste</span></div>
                            <div class="tab-subheading">
                                <span class="pr-2 opactiy-6">
                                    <i class="fa fa-list"></i>
                                </span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link minimal-tab-btn-2 {{ $action == 'add' ? 'active': '' }}" onclick="@this.set('action','add')">
                            <div class="widget-number">
                                <span>Ajouter</span>
                                <span class="pr-2 text-success">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="container">
                    @if($action == 'list')
                    @if($selected == "list")
                    <div class="p-2">
                        <table id="newslet" class="container table table-striped py-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Date Publication</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($news as $new)
                                <tr>
                                    <td class="text-center">
                                        {{ $i++ }}
                                    </td>
                                    <td class="text-left">
                                        {{ $new->title }}
                                    </td>
                                    <td>
                                        <div>
                                            <p>{{ Str::limit($new->description, 100) }}</p>
                    
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        {{date("d/m/Y à H:i:s", strtotime($new->created_at))}}
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:void()" class="btn btn-info" onclick="@this.selectNews({{ $new->id }})">
                                            <i class="fas fa-eye"></i></a>
                                        <a href="javascript:void()" class="btn btn-info" onclick="@this.selectEdit({{ $new->id }})">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            setTimeout(() => {
                                tableAdd('newslet')
                            }, 2000);
                        </script>
                    </div>
                    @elseif($selected == 'view')
                    <div class="p-2">
                        <div class="text-center">
                            <h2 style="font-size: 15px">Affichage de la newsletter</h2>
                        </div>
                        <a href="javascript:void()" class="float-right btn btn-dark pb-1 mr-4 mb-2" style="position: relative" onclick="@this.set('selected','list')">Retour</a>

                        <div class="container">
                            <div class="card mb-3" style="width: 100%;">
                                <div class="row no-gutters">
                                    @if($s_new->image_link != null)
                                    <div class="col-md-6">
                                        <img src="{{asset('storage/'.$s_new->image_link)}}" alt="...">
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        <img src="{{asset('images/default.jpg')}}" alt="...">
                                    </div>
                                    @endif($s_new->image_link == null)
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h4 class="card-title">{{$s_new->title}}</h4>
                                            <p class="card-text text-justify">{{$s_new->description}}</p>
                                            <p class="card-text"><small class="text-muted">{{date("d/m/Y à H:i:s", strtotime($s_new->updated_at))}}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @elseif($selected == 'edit')
                    
                    <h4 class="text-center mt-2" style="font-size: 18px">Modification de Newsletter</h4>
                    @if(!$e_success)
                    <a href="javascript:void()" class="btn btn-dark" onclick="@this.set('selected','list')">Retour</a>
                    <form wire:submit.prevent="submitEditNewsletter({{$e_id}})" style="background-color: antiquewhite; padding:10px; border-radius:10px">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Titre</label>
                                    <input type="text" class="form-control" wire:model="e_title" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="20" wire:model="e_description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mt-4"> <label class="form-label">Ajouter une image (Facultatif)</label>
                                    <input type="file" class="form-control" accept="image/*" wire:model="image" />
                                    <small class="mb-2 d-block">Téléchargez une image pour le newsletter
                                        ici. Il doit répondre à nos normes de qualité d'image de
                                        cours pour être accepté. Consignes importantes :
                                        750 x 440 pixels ; .jpg, .jpeg,. gif ou .png. pas de texte
                                        sur l'image.</small>
                                </div>
                                @if ($e_image)
                                Previsualistion de l'image :
                                <div class="d-flex justify-content-center position-relative rounded py-2 border-white border rounded bg-cover">
                                    <img 
                                    @if ($image  == null)
                                    src="{{asset('storage/'.$e_image)}}"
                                    @else
                                    src="{{$image->temporaryUrl()}}"
                                    @endif
                                     
                                    style="height: 250px; width: 100%" />
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2">
                                    <button class="btn btn-primary float-right">Enregistrer</button>
                                    <a href="javascript:void(0)" onclick="@this.set('selected','list')" class="btn btn-danger float-right mr-3">Annuler</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="scroll-area-sm">
                        <div class="scrollbar-container">
                            <div class="btn btn-dark" onclick="@this.set('e_success',false)">Retour</div>
                            <div class="no-results pt-3 pb-0">
                                <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                    </div>
                                    <span class="swal2-success-line-tip"></span>
                                    <span class="swal2-success-line-long"></span>
                                    <div class="swal2-success-ring"></div>
                                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                </div>
                                <div class="results-subtitle">Modification effectué avec succès!</div>
                                <div class="results-title">Super bien enregistrer !</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    
                    @elseif($action == 'add')
                    <div class="container mt-4" style="background-color: antiquewhite; padding:10px; border-radius:10px">
                        @if(!$success)
                        <form wire:submit.prevent="submitNewsletter()">
                            <div class="d-flex justify-center">
                                <h5 style="font-size:20px" class="text-center">Remplir le formulaire ('Certains champs ne sont pas obligatoires')</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mt-4">
                                        <label for="" class="form-label"><span class="text-danger">*</span> Titre</label>
                                        <input type="text" class="form-control" wire:model="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control" name="" id="" cols="30" rows="20" wire:model="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mt-4">
                                        <label class="form-label">Ajouter une image (Facultatif)</label>
                                        <input type="file" class="form-control-file" accept="image/*" wire:model="image" />
                                        <small class="mb-2 d-block">Téléchargez une image pour le newsletter
                                            ici. Il doit répondre à nos normes de qualité d'image de
                                            cours pour être accepté. Consignes importantes :
                                            750 x 440 pixels ; .jpg, .jpeg,. gif ou .png. pas de texte
                                            sur l'image.</small>
                                    </div>
                                    @if ($image)
                                    Previsualistion de l'image :
                                    <div class="d-flex justify-content-center position-relative rounded py-2 border-white border rounded bg-cover">
                                        <img src="{{ $image->temporaryUrl() }}" style="height: 250px; width: auto" />
                                    </div>
                                    @endif
                                    <!-- <div class="form-group">
                                        <label class="form-label" style="font-size: 12px">Ajouter un document (Facultatif)</label>
                                        <input type="file" class="form-control-file" accept=".pdf" wire:model="file" />
                                        <small class="mb-2 d-block">Téléchargez votre document associé au cours.</small>
                                    </div>
                                    @if($file)
                                    Previsualisation du fichier :
                                    <iframe
                                        class="d-flex justify-content-center position-relative rounded py-2 border-white border rounded bg-cover"
                                        src="{{ $file->temporaryUrl() }}" width="700" height="300"></iframe>
                                    @endif -->
                                    <!-- <div class="mt-4">
                                        <label class="form-label">Resumé en video</label>
                                        <input type="url" class="form-control"
                                            placeholder="URL du resumé en video si vous en disposer" wire:model="video_url" />
                                    </div>
                                    <small class="mt-3 d-block">
                                        Saisissez une URL de vidéo valide. Les
                                        étudiants qui regardent une vidéo promotionnelle bien faite sont
                                        5 fois plus susceptibles de s'inscrire à votre cours.
                                    </small>
                                    <div
                                        class=" d-flex justify-content-center position-relative rounded py-2 border-white border rounded bg-cover">
                                        <div class="post-media wow fadeIn">
                                            @if($video_url)
                                            <iframe width="700" height="544" src="{{ $video_url }}" title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen class="img-responsive img-rounded" style="height: 300px !important">
                                            </iframe>
                                            @else
                                            <iframe width="700" height="544" src="https://www.youtube.com/embed/1hWunZqp"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen class="img-responsive img-rounded" style="height: 300px !important">
                                            </iframe>
                                            @endif
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-2">
                                        <button class="btn btn-primary float-right">Enregistrer</button>
                                        <a href="javascript:void(0)" onclick="@this.set('selected','list')" class="btn btn-danger float-right mr-3">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="scroll-area-sm">
                            <div class="scrollbar-container">
                                <div class="btn btn-dark" onclick="@this.set('success',false)">Retour</div>
                                <div class="no-results pt-3 pb-0">
                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                        </div>
                                        <span class="swal2-success-line-tip"></span>
                                        <span class="swal2-success-line-long"></span>
                                        <div class="swal2-success-ring"></div>
                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                    </div>
                                    <div class="results-subtitle">Enregistrement effectué avec succes!</div>
                                    <div class="results-title">Super bien enregistrer !</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>