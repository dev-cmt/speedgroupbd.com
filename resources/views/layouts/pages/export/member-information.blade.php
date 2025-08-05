<x-reports-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }
        .footer {
            text-align: center;
            padding: 10px;
            /* position: fixed;
            bottom: 0; */
            width: 100%;
        }
        .table th, .table td {
            padding: 0px 10px !important;
        }

        
        .bar {
            position: relative;
            margin: 2.5rem 0 1.5rem 0;
            border-top: 1px solid var(--default);
            padding-bottom: 5px;
        }

        .bar::before{
            content: attr(data-label);
            position: absolute;
            left: 50%;
            transform: translate(-50%, -53%);
            padding: 0 1rem;
            background-color: #fff;
            font-weight: 700;
            text-align: center;
        }

        /* Generate styles for bars A to K */
        [class^="bar"]::before {
            content: "(" attr(data-label) ") " attr(data-title);
        }
    </style>
    <div class="bg-white">
        <div style="width:120px; margin: 0 auto">
            <a href="{{route('/')}}"><img src="{{asset('public/images')}}/logo.png" alt="" width="120"></a>
        </div>
        <div class="card-body">
            <div class="header-title">
                <h4 class="text-center px-2"> BANGLADESH AGRO FEED INGREDIENTS IMPORTERS AND  TRADERS ASSOCIATION </h4>
                <hr>
                <p class="text-center"><em>An agro based ingredients importers and traders association</em></p>
            </div>
            <h5 class="text-center px-4">Membership Opening Form</h5>

            <table class="table table-borderless">
                <tr>
                    <td colspan="4">
                        To,<br>
                        President,<br>
                        Bangladesh Agro Feed Ingredients Importers & Traders Association,<br>
                        63/C, Asad Avenue, Mother’s Home (5th Floor),<br>
                        Mohammadpur, Dhaka-1207, Bangladesh.<br>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <img src="{{ asset('public/' . $data->infoDocument->fileApplicantPhoto) }}" alt="" width="120">
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        Dear Sir, <br>
                        I/we are applying to get registered/enlisted Membership in the following type with your Association. l/we are providing the detailed information below:
                    </td>
                </tr>
            </table>

            <!-- Info Company Section (A) -->
            <div class="bar" data-label="A" data-title="Business Information"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Member Type</strong></td>
                    <td>{{$data->memberType->name}}</td>
                    <td><strong>Member Code</strong></td>
                    <td>{{$data->member_code}}</td>
                </tr>
                <tr>
                    <td><strong>Name of the company</strong></td>
                    <td>{{$data->infoCompany->companyName}}</td>
                    <td><strong>Address of Business Organization /Register</strong></td>
                    <td>{{$data->infoCompany->addressOrganization}}</td>
                </tr>
                <tr>
                    <td><strong>Type Of Ownership</strong></td>
                    <td>
                        @if ($data->infoCompany->typeOwnership == 1) Proprietorship
                        @elseif ($data->infoCompany->typeOwnership == 2) Partnership
                        @elseif ($data->infoCompany->typeOwnership == 3) Privet/Public Ltd.
                        @elseif ($data->infoCompany->typeOwnership == 4) Multinational
                        @elseif ($data->infoCompany->typeOwnership == 5) Others
                        @endif
                    </td>
                    <td><strong>Type Of Business</strong></td>
                    <td>
                        @if ($data->infoCompany->typeOwnership == 1) Proprietorship
                        @elseif ($data->infoCompany->typeOwnership == 2) Partnership
                        @elseif ($data->infoCompany->typeOwnership == 3) Privet/Public Ltd.
                        @elseif ($data->infoCompany->typeOwnership == 4) Multinational
                        @elseif ($data->infoCompany->typeOwnership == 5) Others
                        @endif
                    </td>
                </tr>
            </table>
            <!-- Info Company Section (B) -->
            <div class="bar" data-label="B" data-title="General Information"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Trade License Number (if applicable)</strong></td>
                    <td>{{$data->infoCompany->tradeLicenseNo}}</td>
                    <td><strong>Issue Date</strong></td>
                    <td>{{$data->infoCompany->tradeLicenseDate}}</td>
                </tr>
                <tr>
                    <td><strong>E- TIN Number</strong></td>
                    <td>{{$data->infoCompany->eTinNo}}</td>
                    <td><strong>Issue Date</strong></td>
                    <td>{{$data->infoCompany->eTinDate}}</td>
                </tr>
                <tr>
                    <td><strong>VAT Registration Number</strong></td>
                    <td>{{$data->infoCompany->vatRegistrationNo}}</td>
                    <td><strong>Issue Date</strong></td>
                    <td>{{$data->infoCompany->vatRegistrationDate}}</td>
                </tr>
                <tr>
                    <td><strong>RJSC Incorporation Number</strong></td>
                    <td>{{$data->infoCompany->rjscIncorporationNo}}</td>
                    <td><strong>Issue Date</strong></td>
                    <td>{{$data->infoCompany->rjscIncorporationDate}}</td>
                </tr>
            </table>
            <!-- Info Company Section (C)-->
            <div class="bar" data-label="C" data-title="Trading Brand/Products & Service"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Poultry, Dairy & Fisheries</strong></td>
                    <td>
                        @if ($data->infoCompany->poultryDairyFisheries == 1) Agro Feed Ingredients, Feed Supplement & Feed Additives
                        @else Null
                        @endif
                    </td>
                    <td><strong>Others (if)</strong></td>
                    <td>{{$data->infoCompany->tradingBrandOthers}}</td>
                </tr>
            </table>
            <!-- Info Company Section (D)-->
            <div class="bar" data-label="D" data-title="Contact Information"></div>
            <p>Business Operation Address (Current/Mailing Address)</p>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Name of the company (As in Trade License)</strong></td>
                    <td>{{$data->infoCompany->contactCompanyName}}</td>
                    <td><strong>Address</strong></td>
                    <td>{{$data->infoCompany->contactCompanyAddress}}</td>
                </tr>
                <tr>
                    <td><strong>Cell Number</strong></td>
                    <td>{{$data->infoCompany->contactCompanyNumber}}</td>
                    <td><strong>E-Mail ID</strong></td>
                    <td>{{$data->infoCompany->contactCompanyEmail}}</td>
                </tr>
            </table>
            <!-- Info Personal Section (E)-->
            <div class="bar" data-label="E" data-title="Personal Information"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Name of the Member (As in NID & Trade License)</strong></td>
                    <td>{{$data->infoPersonal->memebrName}}</td>
                    <td><strong>Designation</strong></td>
                    <td>
                        @if ($data->infoPersonal->memebrDesignation == 1) Proprietor
                        @elseif ($data->infoPersonal->memebrDesignation == 2) Managing Director
                        @elseif ($data->infoPersonal->memebrDesignation == 3) Chairman
                        @elseif ($data->infoPersonal->memebrDesignation == 4) CEO
                        @elseif ($data->infoPersonal->memebrDesignation == 5) Partner
                        @elseif ($data->infoPersonal->memebrDesignation == 6) Director
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>NID/Smart Card Number</strong></td>
                    <td>{{$data->infoPersonal->memebrNID}}</td>
                    <td><strong>Date of Birth</strong></td>
                    <td>{{$data->infoPersonal->memebrDOB}}</td>
                </tr>
                <tr>
                    <td><strong>Mothers Name (As in NID)</strong></td>
                    <td>{{$data->infoPersonal->memebrMotherName}}</td>
                    <td><strong>Husband/Spouse Name</strong></td>
                    <td>{{$data->infoPersonal->memebrLifePartner}}</td>
                </tr>
                <tr>
                    <td><strong>Gender</strong></td>
                    <td>
                        @if ($data->infoPersonal->memebrGender == 1) Male
                        @elseif ($data->infoPersonal->memebrGender == 2) Female
                        @endif    
                    </td>
                    <td><strong>Blood Group</strong></td>
                    <td>
                        @if ($data->infoPersonal->memebrBloodGroup == 1) O Positive (0+)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 2) O Negative (0-)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 3) A Positive (A+)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 4) A Negative (A-)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 5) B Positive (B+)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 6) B Negative (B-)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 7) AB Positive (AB+)
                        @elseif ($data->infoPersonal->memebrBloodGroup == 8) AB Negative (AB-)
                        @endif
                    </td>
                    <tr>
                        <td><strong>Mobile Number</strong></td>
                        <td>{{$data->infoPersonal->memberPhoneNo}}</td>
                        <td><strong>Email ID</strong></td>
                        <td>{{$data->infoPersonal->memberEmail}}</td>
                    </tr>
                </tr>
            </table>


            <!-- Info Personal Section (F)-->
            <div class="bar" data-label="F" data-title="Educations Qualification"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>According to the last Academic Certificate Name</strong></td>
                    <td>{{$data->infoPersonal->qualificationName}}</td>
                    {{-- <td><strong>Member</strong></td>
                    <td></td> --}}
                </tr>
            </table>

            <!-- Info Personal Section (G)-->
            <div class="bar" data-label="G" data-title="Authorized Person/Nominee Information"></div>
            <p>Following The named person is hereby authorized Person/ Nominee to represent the company to get registered/enlisted Membership with your Association. I/we are providing the detailed information below:</p>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Nominee Photo</strong></td>
                    <td><img src="{{ asset('public/' . $data->infoDocument->fileNomineePhoto) }}" alt="" width="120"></td>
                    <td><strong>Signature of the Applicant</strong></td>
                    <td><img src="{{ asset('public/' . $data->infoDocument->fileNomineePhoto) }}" alt="" width="120"></td>
                </tr>
                <tr>
                    <td><strong>Name of Authorized Person/Nominee</strong></td>
                    <td>{{$data->infoPersonal->nomineeName}}</td>
                    <td><strong>NID/Smart Card Number</strong></td>
                    <td>{{$data->infoPersonal->nomineeNID}}</td>
                </tr>
                <tr>
                    <td><strong>Fathers/Husband Name</strong></td>
                    <td>{{$data->infoPersonal->nomineeFather}}</td>
                    <td><strong>Mothers Name</strong></td>
                    <td>{{$data->infoPersonal->nomineeMother}}</td>
                </tr>
                <tr>
                    <td><strong>Relation with Member</strong></td>
                    <td>{{$data->infoPersonal->nomineeRelation}}</td>
                    <td><strong>Designation of Representative</strong></td>
                    <td>{{$data->infoPersonal->nomineeDesignation}}</td>
                </tr>
            </table>

            <!-- Info Personal Section (H)-->
            <div class="bar" data-label="H" data-title="Membership Fee Payment Information"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Bank & Branch Name</strong></td>
                    <td>{{$data->infoBank->bankBranceName}}</td>
                    <td><strong>Total Amount (BDT)</strong></td>
                    <td>{{$data->infoBank->totalAmount}}</td>
                </tr>
                <tr>
                    <td><strong>Payment Date</strong></td>
                    <td>{{$data->infoBank->bankBranceName}}</td>
                    <td><strong>Mode of Payment</strong></td>
                    <td>{{$data->infoBank->modePayment}}</td>
                </tr>
                <tr>
                    <td><strong>Add Payment Slip</strong></td>
                    <td>{{$data->infoBank->fileSlip}}</td>
                    <td><strong>Money Receipt No</strong></td>
                    <td>{{$data->infoBank->moneyReceiptNo}}</td>
                </tr>
            </table>

            <!-- Info Personal Section (H)-->
            <div class="bar" data-label="I" data-title="Recommendation Information"></div>
            <h6 class="text-primary">K1 Proposed by BAFIITA Members</h6>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Name of Company</strong></td>
                    <td>{{$data->infoPersonal->kOneCompanyName}}</td>
                    <td><strong>Name of Member/Representative</strong></td>
                    <td>{{$data->infoPersonal->kOneMemberName}}</td>
                    <td><strong>BAFIITA Membership Number</strong></td>
                    <td>{{$data->infoPersonal->kOneMembershipNo}}</td>
                </tr>
            </table>
            <h6 class="text-primary">K2 Proposed by BAFIITA Members</h6>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Name of Company</strong></td>
                    <td>{{$data->infoPersonal->kTwoCompanyName}}</td>
                    <td><strong>Name of Member/Representative</strong></td>
                    <td>{{$data->infoPersonal->kTwoMemberName}}</td>
                    <td><strong>BAFIITA Membership Number</strong></td>
                    <td>{{$data->infoPersonal->kTwoMembershipNo}}</td>
                </tr>
            </table>

            <!-- Info Personal Section (J)-->
            {{-- <div class="bar" data-label="J" data-title="Verified by BAFIITA Secretariat (For office use only)"></div>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Office:</strong></td>
                    <td>{{$data->infoPersonal->description}}</td>
                </tr>
            </table> --}}

        </div>

    </div>
    
    <div class="footer">
        <table class="table table-borderless">
            <tr>
                <!-- Placeholder for Applicant Signature -->
                <td colspan="4"></td>
                <td colspan="4" class="text-center">
                    <h5 style="border-bottom:1px solid #222;padding-bottom:10px">Applicant Signature</h5>
                </td>
                <!-- Placeholder for Signatory Signature -->
                <td colspan="4"></td>
                <td colspan="4" class="text-center">
                    <h5 style="border-bottom:1px solid #222;padding-bottom:10px">Signatory Signature</h5>
                </td>
            </tr>
        </table>        
    </div>
    
    
    
    
</x-reports-layout>