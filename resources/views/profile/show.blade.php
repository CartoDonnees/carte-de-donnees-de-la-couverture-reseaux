<x-app-layout>
    <section class="content">
        <div class="container-fluid">
            <div class="mt-4 m-2">
                <h2 style="font-size: 18px">Profil d'utilisateur</h2>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="text-center d-flex justify-center">
                                    <img class="profile-user-img img-fluid rounded-circle"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                        style="width: 100px; height:100px">
                                </div>
                            @endif
                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul>
                                <li class="nav-item">Parametres du compte
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="settings">
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                            @livewire('profile.update-profile-information-form')

                                            <x-jet-section-border />
                                        @endif

                                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                            <div class="mt-10 sm:mt-0">
                                                @livewire('profile.update-password-form')
                                            </div>

                                            <x-jet-section-border />
                                        @endif

                                        <div class="mt-10 sm:mt-0">
                                            @livewire('profile.logout-other-browser-sessions-form')
                                        </div>

                                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                            <x-jet-section-border />

                                            <div class="mt-10 sm:mt-0">
                                                @livewire('profile.delete-user-form')
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



    <div>
    </div>
</x-app-layout>
