<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="card">
        <div class="card-body">
            <div class="container mt-3">
                @if($com == 'table')
                <h4 class="text-center" style="font-size: 15px">Commentaires liés à l'application</h4>
                <div class="d-flex justify-content-center">
                    {{-- {!! $users->links() !!} --}}
                </div>
                <table style="width: 100%;" id="commentTable" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date d'envoie</th>
                            <th>Statut</th>
                            <th>Action</th>

                            <th>Application lente</th>
                            <th>Problème d'affichage</th>

                            <th>Commentaires</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($AppComments as $comment)
                        <tr>
                            <td>{{ $i=$i++ }}</td>
                            <td>{{date("d/m/Y à H:i:s", strtotime($comment->created_at))}}</td>
                            <td>{{$comment->updated_at == $comment->created_at ? 'Non Traité' : 'Traité'}}</td>
                            <td>
                                <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectComment({{ $comment->id }})"><i class="fas fa-edit"></i></a>
                            </td>

                            <td>{{ $comment->application_lent == 1 ? ' Oui' :' Non'}}</td>
                            <td>{{ $comment->probleme_affichage == 1 ? ' Oui' :' Non'}}</td>

                            <td>{{ $comment->commentaire}}</td>
                        </tr>
                        @php
                        $i=$i+1;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <script>
                    setTimeout(() => {
                        tableAdd('commentTable');
                    }, 1000);
                </script>

<h4 class="text-center mt-12" style="font-size: 15px">Commentaires liés au reseau</h4>
                <div class="d-flex justify-content-center">
                    {{-- {!! $users->links() !!} --}}
                </div>
                <table style="width: 100%;" id="commentAppTable" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Operateur</th>
                            <th>Localité</th>
                            <th>Date d'envoie</th>
                            <th>Statut</th>
                            <th>Action</th>

                            <th>Connexion Internet lente</th>
                            <th>Connexion Internet impossible</th>

                            <th>Appel non fluide</th>
                            <th>Appel impossible</th>

                            <th>Envoi lent des sms</th>
                            <th>Reception lente des sms</th>

                            <th>Envoi des sms impossible</th>
                            <th>Reception des sms impossible</th>

                            <th>Commentaires</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $i=$i++ }}</td>
                            <td>{{ $comment->operateur }}</td>
                            <td>{{ $comment->localite }}</td>
                            <td>{{date("d/m/Y à H:i:s", strtotime($comment->created_at))}}</td>
                            <td>{{$comment->updated_at == $comment->created_at ? 'Non Traité' : 'Traité'}}</td>
                            <td>
                                <a href="javascript:void()" class="btn btn-primary" onclick="@this.selectComment({{ $comment->id }})"><i class="fas fa-edit"></i></a>
                            </td>

                            <td>{{ $comment->connexion_lente == 1 ? ' Oui' :' Non'}}</td>
                            <td>{{ $comment->connexion_impossible == 1 ? ' Oui' :' Non'}}</td>

                            <td>{{ $comment->appel_non_fluide == 1 ? ' Oui' :' Non'}}</td>
                            <td>{{ $comment->appel_impossible == 1 ? ' Oui' :' Non'}}</td>

                            <td>{{ $comment->envoi_sms_lent == 1 ? ' Oui' :' Non'}}</td>
                            <td>{{ $comment->reception_sms_lent == 1 ? ' Oui' :' Non'}}</td>

                            <td>{{ $comment->envoi_sms_impossible == 1 ? ' Oui' :' Non'}}</td>
                            <td>{{ $comment->reception_sms_impossible == 1 ? ' Oui' :' Non'}}</td>


                            <td>{{ $comment->commentaire}}</td>
                        </tr>
                        @php
                        $i=$i+1;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                <script>
                    setTimeout(() => {
                        tableAdd('commentAppTable');
                    }, 1000);
                </script>

                @elseif ($com == 'traiter' )

                @if ($alertCommentMessage != null)

                <div class="alert alert-success" role="alert">
                    {{$alertCommentMessage}}
                </div>
                <div class="btn btn-dark ml-2" onclick="@this.retourComment()">Retour</div>
                @elseif ($alertCommentMessage == null)
                <form wire:submit.prevent="retourComment()">
                    @csrf
                    @if ($commentOperateur != null)
                    <h2 style="font-size: 18px; font-weight:bold">Problème avec le réseau</h2>
                    <div class="row">
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Opérateur</label>
                            <input type="text" wire:model="commentOperateur" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Localité</label>
                            <input type="text" wire:model="commentLocalite" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>

                    <div class="row">
                        @if ($commentInternet != null)
                        <div class="form-group col">
                            <label for="exampleFormControlTextarea1">Problème avec l'Internet</label>
                            <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="4" wire:model="commentInternet" disabled></textarea>
                        </div>
                        @endif
                        @if ($commentAppel != null)
                        <div class="form-group col">
                            <label for="exampleFormControlTextarea1">Problème avec les appels</label>
                            <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="4" wire:model="commentAppel" disabled></textarea>
                        </div>
                        @endif
                        @if ($commentSms != null)
                        <div class="form-group col">
                            <label for="exampleFormControlTextarea1">Problème avec les SMS</label>
                            <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="4" wire:model="commentSms" disabled></textarea>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if ($commentAppli != null)
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" style="font-size: 18px; font-weight:bold">Problème avec l'application</label>
                        <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="4" wire:model="commentAppli" disabled></textarea>
                    </div>
                    @endif
                    @if ($commentText != null)
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" style="font-size: 18px; font-weight:bold">Suggestion du repondant</label>
                        <textarea class="form-control text-justify" id="exampleFormControlTextarea1" rows="4" wire:model="commentText" disabled></textarea>
                    </div>
                    @endif

                    <div class="row">
                        @if($mail != null)
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Mail</label>
                            <input type="email" wire:model="mail" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                        @endif

                        @if($telephone != null)
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Telephone :</label>
                            <input type="tel" wire:model="telephone" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Date du post:</label>
                            <input type="datetime" wire:model="commentCreation" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                        @if($statut == 'Traiter')
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Date de Traitement</label>
                            <input type="datetime" wire:model="commentSolution" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                        @endif
                        <div class=" col form-group">
                            <label for="exampleFormControlInput1">Statut</label>
                            <input type="text" wire:model="statut" class="form-control" id="exampleFormControlInput1" placeholder="" disabled>
                        </div>
                    </div>

                    <div class="flex items-center justify-end m-2">
                        @if ($statut == 'Non Traiter')
                        <div class="btn btn-primary ml-4" onclick="@this.commentUpdate({{$commentId}})">Problème Traité</div>
                        @endif
                        <div class="btn btn-success ml-2" onclick="@this.commentDelete({{$commentId}})">Supprimer</div>
                        <x-jet-button class="ml-4 btn-dark ">
                            {{ __('Retour') }}
                        </x-jet-button>
                    </div>
                </form>
                @endif

                @endif


            </div>
        </div>
    </div>


</div>