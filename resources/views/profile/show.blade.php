<x-app-layout>
    <style>
        /*__________________Image Profile______________________*/
        .avatar-upload {
            position: relative;
            max-width: 240px;
            margin: 10px auto;
        }
        .avatar-upload .avatar-edit {
        position: absolute;
        right: 5px;
        z-index: 1;
        top: 10px;
        }
        .avatar-upload .avatar-edit input {
        display: none;
        }
        .avatar-upload .avatar-edit input + label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 0%;
        background: #ff0000;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
        padding: 7px 9px;
        color: #fff;
        }
        .avatar-upload .avatar-edit input + label:hover {
        background: #c00000;
        }
        .avatar-upload .avatar-preview {
            width: 240px;
            height: 240px;
            position: relative;
            border-radius: 0%;
            border: 6px solid #ff0000;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 0%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-10 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="p-4 bg-dark">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-4">
                            <div class="rounded mb-2 img-thumbnail" style="width:150px;height:150px;overflow:hidden">
                                <img src="{{asset('public/images')}}/profile/{{ $user->profile_photo_path }}" alt="..." style="height: 100%;width: 100%;object-fit: cover;">
                            </div>
                            @if ($user->id == Auth::user()->id)
                                <a href="{{route('info_member.edit', $user->id)}}" class="btn btn-primary light text-white btn-sl-sm btn-block"><i class="fa fa-pencil mr-2"></i> Edit profile</a>
                            @endif
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="text-white">{{$user->name}}</h4>
                            <p class="small mb-5"><i class="fa fa-calendar-o mr-2"></i>{{date("j F, Y", strtotime($user->created_at))}}</p>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            @if ($user->id == Auth::user()->id)
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link {{Session::has('info_update') ? '' : 'active'}}">Member Information</a></li>
                                    <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link {{Session::has('info_update') ? 'active' : ''}}">Other Information</a></li>
                                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link {{Session::has('messege') || $errors->any() ? 'active' : ''}}">Setting</a></li>
                                </ul>
                            @endif

                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade {{Session::has('messege') || Session::has('info_update') || $errors->any() ? '' : 'active show'}}">
                                    <!--=====//A Business Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">A Business Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Member Type <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->memberType->name ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Member Code <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->member_code ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of the company <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->companyName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address of Business Organization /Register <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->addressOrganization ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Type Of Ownership <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoCompany && isset($infoCompany->typeOwnership))
                                                        @if($infoCompany->typeOwnership == 1)
                                                            <span>Partnership</span>
                                                        @elseif($infoCompany->typeOwnership == 2)
                                                            <span>Partnership</span>
                                                        @elseif($infoCompany->typeOwnership == 3)
                                                            <span>Privet/Pudee Ltd.</span>
                                                        @elseif($infoCompany->typeOwnership == 4)
                                                            <span>Multinational</span>
                                                        @elseif($infoCompany->typeOwnership == 5)
                                                            <span>Others</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Type Of Ownership</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Type Of Business <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoCompany && isset($infoCompany->typeBusiness))
                                                        @if($infoCompany->typeBusiness == 1)
                                                            <span>Import, Trading & Supply</span>
                                                        @elseif($infoCompany->typeBusiness == 2)
                                                            <span>Local Manufacturing</span>
                                                        @elseif($infoCompany->typeBusiness == 3)
                                                            <span>Trading</span>
                                                        @elseif($infoCompany->typeBusiness == 4)
                                                            <span>Others</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Type Of Business</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--=====// B General Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3"> B General Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Trade License Number (if applicable) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->tradeLicenseNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Issue Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->tradeLicenseDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">E- TIN (if applicable) Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->eTinNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Issue Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->eTinDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">VAT Registration Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->vatRegistrationNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Issue Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->vatRegistrationDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        {{-- <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">IRC Import Registration Certificate Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->ircCertificateNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Issue Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->ircCertificateDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div> --}}
                                        <!--Item-->
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">RJSC Incorporation Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->rjscIncorporationNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Issue Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->rjscIncorporationDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <!--=====// C Trading Brand/Products & Service//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">C Trading Brand/Products & Service</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Poultry, Dairy & Fisheries <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoCompany && isset($infoCompany->poultryDairyFisheries))
                                                        @if($infoCompany->poultryDairyFisheries == 1)
                                                            <span>Agro Feed Ingredients, Feed Supplement & Feed Additives</span>
                                                        @elseif($infoCompany->poultryDairyFisheries == 2)
                                                            <span>Feed Supplement & Feed Additives</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Poultry, Dairy & Fisheries</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Others ( if ) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->tradingBrandOthers ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--=====//D Contact Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">D Contact Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of the company (As in Trade License) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->contactCompanyName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->contactCompanyAddress ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Cell Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->contactCompanyNumber ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">E-Mail ID <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoCompany->contactCompanyEmail ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--=====//E Personal Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">E Personal Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of the Member (As in NID & Trade License) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memebrName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Designation <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoPersonal && isset($infoPersonal->memebrDesignation))
                                                        @if($infoPersonal->memebrDesignation == 1)
                                                            <span>Proprietor</span>
                                                        @elseif($infoPersonal->memebrDesignation == 2)
                                                            <span>Managing Director</span>
                                                        @elseif($infoPersonal->memebrDesignation == 3)
                                                            <span>Chairman</span>
                                                        @elseif($infoPersonal->memebrDesignation == 4)
                                                            <span>CEO</span>
                                                        @elseif($infoPersonal->memebrDesignation == 5)
                                                            <span>Partner</span>
                                                        @elseif($infoPersonal->memebrDesignation == 6)
                                                            <span>Director</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Member Designation</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">NID/Smart Card Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memebrNID ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Date of Birth <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memebrDOB ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mothers Name (As in NID) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memebrMotherName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Husband/Spouse Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memebrLifePartner ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Gender <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoPersonal && isset($infoPersonal->memebrGender))
                                                        @if($infoPersonal->memebrGender == 1)
                                                            <span>Male</span>
                                                        @elseif($infoPersonal->memebrGender == 2)
                                                            <span>Female</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Gender</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Blood Group <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoPersonal && isset($infoPersonal->memebrBloodGroup))
                                                        @if($infoPersonal->memebrBloodGroup == 1)
                                                            <span>O Positive (0+)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 2)
                                                            <span>O Negative (0-)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 3)
                                                            <span>A Positive (A+)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 4)
                                                            <span>A Negative (A-)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 5)
                                                            <span>B Positive (B+)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 6)
                                                            <span>B Negative (B-)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 7)
                                                            <span>AB Positive (AB+)</span>
                                                        @elseif($infoPersonal->memebrBloodGroup == 8)
                                                            <span>AB Negative (AB-)</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown Blood Group</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mobile Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memberPhoneNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Email ID <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->memberEmail ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">According to the last Academic Certificate Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->qualificationName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--=====//G Authorized Person/Nominee Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">G Authorized Person/Nominee Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of Authorized Person/Nominee <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">NID/Smart Card Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeNID ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Fathers /Husband Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeFather ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mothers Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeMother ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Relation with Member <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeRelation ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Designation of Representative <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nomineeDesignation ?? 'Null' }}</span></div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--=====// H Membership Fee Payment Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">H Membership Fee Payment Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Bank & Branch Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoBank->bankBranceName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>

                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Total Amount (BDT) <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoBank->totalAmount ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Payment Date <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoBank->paymentDate ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mode of Payment <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoBank->modePayment ?? 'BANK' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Money Receipt No <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoBank->moneyReceiptNo ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--=====// I Recommendation Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">I Recommendation Information</h6>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="text-info my-3">K1 Proposed by BAFIITA Members</p>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of Company <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->kOneCompanyName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of Member/Representative <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->kOneMemberName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">BAFIITA Membership Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoPersonal && isset($infoPersonal->kOneMembershipNo))
                                                        @if($infoPersonal->kOneMembershipNo == 1)
                                                            <span>Donor</span>
                                                        @elseif($infoPersonal->kOneMembershipNo == 2)
                                                            <span>General</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown K1 Membership Number</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <p class="text-info my-3">K2 Seconded by BAFIITA Members</p>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of Company <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->kTwoCompanyName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Name of Member/Representative <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->kTwoMemberName ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">BAFIITA Membership Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if($infoPersonal && isset($infoPersonal->kTwoMembershipNo))
                                                        @if($infoPersonal->kTwoMembershipNo == 1)
                                                            <span>Donor</span>
                                                        @elseif($infoPersonal->kTwoMembershipNo == 2)
                                                            <span>General</span>
                                                        @endif
                                                    @else
                                                        <span>Unknown K2 Membership Number</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--=====// Verified by BAFIITA Secretariat (For office use only)//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Verified by BAFIITA Secretariat (For office use only)</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-12 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-4">
                                                    <h6 class="f-w-500">Comment: <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-9 col-8"><span>{{ $infoPersonal->description ?? 'Null' }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div id="about-me" class="tab-pane fade {{Session::has('info_update') ? 'active show' : ''}}">
                                    <!--=====// Other Information //=====-->
                                    @if (!is_null($infoOther) && !is_null($infoOther->id))
                                        <form action="{{ route('info_other.update', $infoOther->id )}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">About Me</label>
                                                        <div class="col-lg-10">
                                                            <textarea name="about_me" class="form-control @error('about_me') is-invalid @enderror" rows="2" id="comment" placeholder="What would you like to see?">{{$infoOther->about_me}}</textarea>
                                                            @error('about_me')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Facebook Link</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group mb-3  input-success">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                                                                </div>
                                                                <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://www.facebook.com" value="{{$infoOther->facebook_url}}">
                                                                @error('facebook_url')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Youtube Link</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group mb-3  input-success">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                                                                </div>
                                                                <input type="text" name="youtube_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://www.youtube.com" value="{{$infoOther->youtube_url}}">
                                                                @error('youtube_url')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Twitter Link</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group mb-3  input-success">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                                                                </div>
                                                                <input type="text" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="https://twitter.com" value="{{$infoOther->twitter_url}}">
                                                                @error('twitter_url')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Instagram Link</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group mb-3  input-success">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                                                                </div>
                                                                <input type="text" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="https://www.instagram.com" value="{{$infoOther->instagram_url}}">
                                                                @error('instagram_url')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Linkedin Link</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group mb-3  input-success">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fa fa-linkedin"></i></span>
                                                                </div>
                                                                <input type="text" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="https://www.linkedin.com" value="{{$infoOther->linkedin_url}}">
                                                                @error('linkedin_url')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                                <div id="profile-settings" class="tab-pane fade {{Session::has('messege') || $errors->any() ? 'active show' : ''}}">
                                     <!--=====// Change Profile //=====-->
                                     <form method="POST" action="{{ route('change.password', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!--Item-->
                                            <div class="col-lg-12">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger solid alert-dismissible fade show mt-2">
                                                        @foreach ($errors->all() as $error)
                                                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                            <strong>Error!</strong> {{$error}}.
                                                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xl-7 col-sm-12 mt-3">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Email</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="" value="{{$user->email }}" disabled>                                     
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Member ID</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('member_code') is-invalid @enderror" name="name" placeholder="" value="{{$user->member_code }}" disabled>                                     
                                                        @error('member_code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Member Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="" value="{{$user->name }}">                                     
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="current_password" class="col-lg-5 col-form-label">Current Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{old('current_password')}}" autocomplete="current-password">
                                                        @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">New Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" autocomplete="new-password">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-sm-12 ">
                                                <div class="skip-email text-center">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' name="profile_photo_path" class="@error('profile_photo_path') is-invalid @enderror form-control" id="imageUpload" accept=".png,.jpg,.jpeg,.gif,.svg" value="{{old('profile_photo_path')}}"/>                                    <label for="imageUpload"><i class="fa fa-camera"></i></label>
                                                            @error('profile_photo_path')
                                                                <span class="invalid-feedback" role="alert" style="position: absolute;top: 195px;left: -180px;width: 300px;">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <label for="imageUpload">
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview" style="background-image: url('{{asset('public/images')}}/profile/{{ $user->profile_photo_path }}');"></div>
                                                            </div>
                                                        </label>
                                                        <button type="submit" class="btn btn-primary d-flex" style="width:100%;justify-content: center;">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End profile widget -->
    
        </div>
    </div>
    <!--Image Profile-->
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
            $('.submit-btn').css('background-color', '#68cf29');
            $(".submit-btn").removeAttr('disabled');
        });
    </script>
</x-app-layout>
  

