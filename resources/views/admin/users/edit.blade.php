@extends('layouts.app')
   
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form class="form" action="{{ route('admin.users.update', $user->guid) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="form-group m-t-40 row">
							<label for="reference" class="col-md-2 col-sm-12 col-form-label text-right">{{ trans('global.Reference') }}</label>
							<div class="col-md-10 col-sm-12">
								<input name="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ $user->reference }}">
								@if($errors->has('reference'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('reference') }}</strong>
								</span>
								@endif
							</div>
						</div>
						
						<div class="form-group row">
							<label for="name" class="col-md-2 col-sm-12 col-form-label text-right">{{ trans('global.Name') }} <span class="text-danger">*</span></label>
							<div class="col-md-10 col-sm-12">
								<input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required>
								@if($errors->has('name'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-md-2 col-sm-12 col-form-label text-right">{{ trans('global.Email') }} <span class="text-danger">*</span></label>
							<div class="col-md-10 col-sm-12">
								<input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ $user->email }}" required>
								@if($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="cellphone" class="col-md-2 col-sm-12 col-form-label text-right">{{ trans('global.CellPhone') }} <span class="text-danger">*</span></label>
							<div class="col-md-10 col-sm-12">
								<div class="row mr-0 ml-0">
									<select name="cellphone_code" class="custom-select col-md-5 col-sm-12 mb-1">
										<option data-countryCode="GB" value="44" {{ $user->cellphone_code == 44 ? 'selected' : '' }}>UK (+44)</option>
										<option data-countryCode="US" value="1" {{ $user->cellphone_code == 1 ? 'selected' : '' }}>USA (+1)</option>
										<option data-countryCode="DZ" value="213" {{ $user->cellphone_code == 213 ? 'selected' : '' }}>Algeria (+213)</option>
										<option data-countryCode="AD" value="376" {{ $user->cellphone_code == 376 ? 'selected' : '' }}>Andorra (+376)</option>
										<option data-countryCode="AO" value="244" {{ $user->cellphone_code == 244 ? 'selected' : '' }}>Angola (+244)</option>
										<option data-countryCode="AI" value="1264" {{ $user->cellphone_code == 1264 ? 'selected' : '' }}>Anguilla (+1264)</option>
										<option data-countryCode="AG" value="1268" {{ $user->cellphone_code == 1268 ? 'selected' : '' }}>Antigua &amp; Barbuda (+1268)</option>
										<option data-countryCode="AR" value="54" {{ $user->cellphone_code == 54 ? 'selected' : '' }}>Argentina (+54)</option>
										<option data-countryCode="AM" value="374" {{ $user->cellphone_code == 374 ? 'selected' : '' }}>Armenia (+374)</option>
										<option data-countryCode="AW" value="297" {{ $user->cellphone_code == 297 ? 'selected' : '' }}>Aruba (+297)</option>
										<option data-countryCode="AU" value="61" {{ $user->cellphone_code == 61 ? 'selected' : '' }}>Australia (+61)</option>
										<option data-countryCode="AT" value="43" {{ $user->cellphone_code == 43 ? 'selected' : '' }}>Austria (+43)</option>
										<option data-countryCode="AZ" value="994" {{ $user->cellphone_code == 994 ? 'selected' : '' }}>Azerbaijan (+994)</option>
										<option data-countryCode="BS" value="1242" {{ $user->cellphone_code == 1242 ? 'selected' : '' }}>Bahamas (+1242)</option>
										<option data-countryCode="BH" value="973" {{ $user->cellphone_code == 973 ? 'selected' : '' }}>Bahrain (+973)</option>
										<option data-countryCode="BD" value="880" {{ $user->cellphone_code == 880 ? 'selected' : '' }}>Bangladesh (+880)</option>
										<option data-countryCode="BB" value="1246" {{ $user->cellphone_code == 1246 ? 'selected' : '' }}>Barbados (+1246)</option>
										<option data-countryCode="BY" value="375" {{ $user->cellphone_code == 375 ? 'selected' : '' }}>Belarus (+375)</option>
										<option data-countryCode="BE" value="32" {{ $user->cellphone_code == 32 ? 'selected' : '' }}>Belgium (+32)</option>
										<option data-countryCode="BZ" value="501" {{ $user->cellphone_code == 501 ? 'selected' : '' }}>Belize (+501)</option>
										<option data-countryCode="BJ" value="229" {{ $user->cellphone_code == 229 ? 'selected' : '' }}>Benin (+229)</option>
										<option data-countryCode="BM" value="1441" {{ $user->cellphone_code == 1441 ? 'selected' : '' }}>Bermuda (+1441)</option>
										<option data-countryCode="BT" value="975" {{ $user->cellphone_code == 975 ? 'selected' : '' }}>Bhutan (+975)</option>
										<option data-countryCode="BO" value="591" {{ $user->cellphone_code == 591 ? 'selected' : '' }}>Bolivia (+591)</option>
										<option data-countryCode="BA" value="387" {{ $user->cellphone_code == 387 ? 'selected' : '' }}>Bosnia Herzegovina (+387)</option>
										<option data-countryCode="BW" value="267" {{ $user->cellphone_code == 267 ? 'selected' : '' }}>Botswana (+267)</option>
										<option data-countryCode="BR" value="55" {{ $user->cellphone_code == 55 ? 'selected' : '' }}>Brazil (+55)</option>
										<option data-countryCode="BN" value="673" {{ $user->cellphone_code == 673 ? 'selected' : '' }}>Brunei (+673)</option>
										<option data-countryCode="BG" value="359" {{ $user->cellphone_code == 359 ? 'selected' : '' }}>Bulgaria (+359)</option>
										<option data-countryCode="BF" value="226" {{ $user->cellphone_code == 226 ? 'selected' : '' }}>Burkina Faso (+226)</option>
										<option data-countryCode="BI" value="257" {{ $user->cellphone_code == 257 ? 'selected' : '' }}>Burundi (+257)</option>
										<option data-countryCode="KH" value="855" {{ $user->cellphone_code == 855 ? 'selected' : '' }}>Cambodia (+855)</option>
										<option data-countryCode="CM" value="237" {{ $user->cellphone_code == 237 ? 'selected' : '' }}>Cameroon (+237)</option>
										<option data-countryCode="CA" value="1" {{ $user->cellphone_code == 1 ? 'selected' : '' }}>Canada (+1)</option>
										<option data-countryCode="CV" value="238" {{ $user->cellphone_code == 238 ? 'selected' : '' }}>Cape Verde Islands (+238)</option>
										<option data-countryCode="KY" value="1345" {{ $user->cellphone_code == 1345 ? 'selected' : '' }}>Cayman Islands (+1345)</option>
										<option data-countryCode="CF" value="236" {{ $user->cellphone_code == 236 ? 'selected' : '' }}>Central African Republic (+236)</option>
										<option data-countryCode="CL" value="56" {{ $user->cellphone_code == 56 ? 'selected' : '' }}>Chile (+56)</option>
										<option data-countryCode="CN" value="86" {{ $user->cellphone_code == 86 ? 'selected' : '' }}>China (+86)</option>
										<option data-countryCode="CO" value="57" {{ $user->cellphone_code == 57 ? 'selected' : '' }}>Colombia (+57)</option>
										<option data-countryCode="KM" value="269" {{ $user->cellphone_code == 269 ? 'selected' : '' }}>Comoros (+269)</option>
										<option data-countryCode="CG" value="242" {{ $user->cellphone_code == 242 ? 'selected' : '' }}>Congo (+242)</option>
										<option data-countryCode="CK" value="682" {{ $user->cellphone_code == 682 ? 'selected' : '' }}>Cook Islands (+682)</option>
										<option data-countryCode="CR" value="506" {{ $user->cellphone_code == 506 ? 'selected' : '' }}>Costa Rica (+506)</option>
										<option data-countryCode="HR" value="385" {{ $user->cellphone_code == 385 ? 'selected' : '' }}>Croatia (+385)</option>
										<option data-countryCode="CU" value="53" {{ $user->cellphone_code == 53 ? 'selected' : '' }}>Cuba (+53)</option>
										<option data-countryCode="CY" value="90392" {{ $user->cellphone_code == 90392 ? 'selected' : '' }}>Cyprus North (+90392)</option>
										<option data-countryCode="CY" value="357" {{ $user->cellphone_code == 357 ? 'selected' : '' }}>Cyprus South (+357)</option>
										<option data-countryCode="CZ" value="42" {{ $user->cellphone_code == 42 ? 'selected' : '' }}>Czech Republic (+42)</option>
										<option data-countryCode="DK" value="45" {{ $user->cellphone_code == 45 ? 'selected' : '' }}>Denmark (+45)</option>
										<option data-countryCode="DJ" value="253" {{ $user->cellphone_code == 253 ? 'selected' : '' }}>Djibouti (+253)</option>
										<option data-countryCode="DM" value="1809" {{ $user->cellphone_code == 1809 ? 'selected' : '' }}>Dominica (+1809)</option>
										<option data-countryCode="DO" value="1809" {{ $user->cellphone_code == 1809 ? 'selected' : '' }}>Dominican Republic (+1809)</option>
										<option data-countryCode="EC" value="593" {{ $user->cellphone_code == 593 ? 'selected' : '' }}>Ecuador (+593)</option>
										<option data-countryCode="EG" value="20" {{ $user->cellphone_code == 20 ? 'selected' : '' }}>Egypt (+20)</option>
										<option data-countryCode="SV" value="503" {{ $user->cellphone_code == 503 ? 'selected' : '' }}>El Salvador (+503)</option>
										<option data-countryCode="GQ" value="240" {{ $user->cellphone_code == 240 ? 'selected' : '' }}>Equatorial Guinea (+240)</option>
										<option data-countryCode="ER" value="291" {{ $user->cellphone_code == 291 ? 'selected' : '' }}>Eritrea (+291)</option>
										<option data-countryCode="EE" value="372" {{ $user->cellphone_code == 372 ? 'selected' : '' }}>Estonia (+372)</option>
										<option data-countryCode="ET" value="251" {{ $user->cellphone_code == 251 ? 'selected' : '' }}>Ethiopia (+251)</option>
										<option data-countryCode="FK" value="500" {{ $user->cellphone_code == 500 ? 'selected' : '' }}>Falkland Islands (+500)</option>
										<option data-countryCode="FO" value="298" {{ $user->cellphone_code == 298 ? 'selected' : '' }}>Faroe Islands (+298)</option>
										<option data-countryCode="FJ" value="679" {{ $user->cellphone_code == 679 ? 'selected' : '' }}>Fiji (+679)</option>
										<option data-countryCode="FI" value="358" {{ $user->cellphone_code == 358 ? 'selected' : '' }}>Finland (+358)</option>
										<option data-countryCode="FR" value="33" {{ $user->cellphone_code == 33 ? 'selected' : '' }}>France (+33)</option>
										<option data-countryCode="GF" value="594" {{ $user->cellphone_code == 594 ? 'selected' : '' }}>French Guiana (+594)</option>
										<option data-countryCode="PF" value="689" {{ $user->cellphone_code == 689 ? 'selected' : '' }}>French Polynesia (+689)</option>
										<option data-countryCode="GA" value="241" {{ $user->cellphone_code == 241 ? 'selected' : '' }}>Gabon (+241)</option>
										<option data-countryCode="GM" value="220" {{ $user->cellphone_code == 220 ? 'selected' : '' }}>Gambia (+220)</option>
										<option data-countryCode="GE" value="7880" {{ $user->cellphone_code == 7880 ? 'selected' : '' }}>Georgia (+7880)</option>
										<option data-countryCode="DE" value="49" {{ $user->cellphone_code == 49 ? 'selected' : '' }}>Germany (+49)</option>
										<option data-countryCode="GH" value="233" {{ $user->cellphone_code == 233 ? 'selected' : '' }}>Ghana (+233)</option>
										<option data-countryCode="GI" value="350" {{ $user->cellphone_code == 350 ? 'selected' : '' }}>Gibraltar (+350)</option>
										<option data-countryCode="GR" value="30" {{ $user->cellphone_code == 30 ? 'selected' : '' }}>Greece (+30)</option>
										<option data-countryCode="GL" value="299" {{ $user->cellphone_code == 299 ? 'selected' : '' }}>Greenland (+299)</option>
										<option data-countryCode="GD" value="1473" {{ $user->cellphone_code == 1473 ? 'selected' : '' }}>Grenada (+1473)</option>
										<option data-countryCode="GP" value="590" {{ $user->cellphone_code == 590 ? 'selected' : '' }}>Guadeloupe (+590)</option>
										<option data-countryCode="GU" value="671" {{ $user->cellphone_code == 671 ? 'selected' : '' }}>Guam (+671)</option>
										<option data-countryCode="GT" value="502" {{ $user->cellphone_code == 502 ? 'selected' : '' }}>Guatemala (+502)</option>
										<option data-countryCode="GN" value="224" {{ $user->cellphone_code == 224 ? 'selected' : '' }}>Guinea (+224)</option>
										<option data-countryCode="GW" value="245" {{ $user->cellphone_code == 245 ? 'selected' : '' }}>Guinea - Bissau (+245)</option>
										<option data-countryCode="GY" value="592" {{ $user->cellphone_code == 592 ? 'selected' : '' }}>Guyana (+592)</option>
										<option data-countryCode="HT" value="509" {{ $user->cellphone_code == 509 ? 'selected' : '' }}>Haiti (+509)</option>
										<option data-countryCode="HN" value="504" {{ $user->cellphone_code == 504 ? 'selected' : '' }}>Honduras (+504)</option>
										<option data-countryCode="HK" value="852" {{ $user->cellphone_code == 852 ? 'selected' : '' }}>Hong Kong (+852)</option>
										<option data-countryCode="HU" value="36" {{ $user->cellphone_code == 36 ? 'selected' : '' }}>Hungary (+36)</option>
										<option data-countryCode="IS" value="354" {{ $user->cellphone_code == 354 ? 'selected' : '' }}>Iceland (+354)</option>
										<option data-countryCode="IN" value="91" {{ $user->cellphone_code == 91 ? 'selected' : '' }}>India (+91)</option>
										<option data-countryCode="ID" value="62" {{ $user->cellphone_code == 62 ? 'selected' : '' }}>Indonesia (+62)</option>
										<option data-countryCode="IR" value="98" {{ $user->cellphone_code == 98 ? 'selected' : '' }}>Iran (+98)</option>
										<option data-countryCode="IQ" value="964" {{ $user->cellphone_code == 964 ? 'selected' : '' }}>Iraq (+964)</option>
										<option data-countryCode="IE" value="353" {{ $user->cellphone_code == 353 ? 'selected' : '' }}>Ireland (+353)</option>
										<option data-countryCode="IL" value="972" {{ $user->cellphone_code == 972 ? 'selected' : '' }}>Israel (+972)</option>
										<option data-countryCode="IT" value="39" {{ $user->cellphone_code == 39 ? 'selected' : '' }}>Italy (+39)</option>
										<option data-countryCode="JM" value="1876" {{ $user->cellphone_code == 1876 ? 'selected' : '' }}>Jamaica (+1876)</option>
										<option data-countryCode="JP" value="81" {{ $user->cellphone_code == 81 ? 'selected' : '' }}>Japan (+81)</option>
										<option data-countryCode="JO" value="962" {{ $user->cellphone_code == 962 ? 'selected' : '' }}>Jordan (+962)</option>
										<option data-countryCode="KZ" value="7" {{ $user->cellphone_code == 7 ? 'selected' : '' }}>Kazakhstan (+7)</option>
										<option data-countryCode="KE" value="254" {{ $user->cellphone_code == 254 ? 'selected' : '' }}>Kenya (+254)</option>
										<option data-countryCode="KI" value="686" {{ $user->cellphone_code == 686 ? 'selected' : '' }}>Kiribati (+686)</option>
										<option data-countryCode="KP" value="850" {{ $user->cellphone_code == 850 ? 'selected' : '' }}>Korea North (+850)</option>
										<option data-countryCode="KR" value="82" {{ $user->cellphone_code == 82 ? 'selected' : '' }}>Korea South (+82)</option>
										<option data-countryCode="KW" value="965" {{ $user->cellphone_code == 965 ? 'selected' : '' }}>Kuwait (+965)</option>
										<option data-countryCode="KG" value="996" {{ $user->cellphone_code == 996 ? 'selected' : '' }}>Kyrgyzstan (+996)</option>
										<option data-countryCode="LA" value="856" {{ $user->cellphone_code == 856 ? 'selected' : '' }}>Laos (+856)</option>
										<option data-countryCode="LV" value="371" {{ $user->cellphone_code == 371 ? 'selected' : '' }}>Latvia (+371)</option>
										<option data-countryCode="LB" value="961" {{ $user->cellphone_code == 961 ? 'selected' : '' }}>Lebanon (+961)</option>
										<option data-countryCode="LS" value="266" {{ $user->cellphone_code == 266 ? 'selected' : '' }}>Lesotho (+266)</option>
										<option data-countryCode="LR" value="231" {{ $user->cellphone_code == 231 ? 'selected' : '' }}>Liberia (+231)</option>
										<option data-countryCode="LY" value="218" {{ $user->cellphone_code == 218 ? 'selected' : '' }}>Libya (+218)</option>
										<option data-countryCode="LI" value="417" {{ $user->cellphone_code == 417 ? 'selected' : '' }}>Liechtenstein (+417)</option>
										<option data-countryCode="LT" value="370" {{ $user->cellphone_code == 370 ? 'selected' : '' }}>Lithuania (+370)</option>
										<option data-countryCode="LU" value="352" {{ $user->cellphone_code == 352 ? 'selected' : '' }}>Luxembourg (+352)</option>
										<option data-countryCode="MO" value="853" {{ $user->cellphone_code == 853 ? 'selected' : '' }}>Macao (+853)</option>
										<option data-countryCode="MK" value="389" {{ $user->cellphone_code == 389 ? 'selected' : '' }}>Macedonia (+389)</option>
										<option data-countryCode="MG" value="261" {{ $user->cellphone_code == 261 ? 'selected' : '' }}>Madagascar (+261)</option>
										<option data-countryCode="MW" value="265" {{ $user->cellphone_code == 265 ? 'selected' : '' }}>Malawi (+265)</option>
										<option data-countryCode="MY" value="60" {{ $user->cellphone_code == 60 ? 'selected' : '' }}>Malaysia (+60)</option>
										<option data-countryCode="MV" value="960" {{ $user->cellphone_code == 960 ? 'selected' : '' }}>Maldives (+960)</option>
										<option data-countryCode="ML" value="223" {{ $user->cellphone_code == 223 ? 'selected' : '' }}>Mali (+223)</option>
										<option data-countryCode="MT" value="356" {{ $user->cellphone_code == 356 ? 'selected' : '' }}>Malta (+356)</option>
										<option data-countryCode="MH" value="692" {{ $user->cellphone_code == 692 ? 'selected' : '' }}>Marshall Islands (+692)</option>
										<option data-countryCode="MQ" value="596" {{ $user->cellphone_code == 596 ? 'selected' : '' }}>Martinique (+596)</option>
										<option data-countryCode="MR" value="222" {{ $user->cellphone_code == 222 ? 'selected' : '' }}>Mauritania (+222)</option>
										<option data-countryCode="YT" value="269" {{ $user->cellphone_code == 269 ? 'selected' : '' }}>Mayotte (+269)</option>
										<option data-countryCode="MX" value="52" {{ $user->cellphone_code == 52 ? 'selected' : '' }}>Mexico (+52)</option>
										<option data-countryCode="FM" value="691" {{ $user->cellphone_code == 691 ? 'selected' : '' }}>Micronesia (+691)</option>
										<option data-countryCode="MD" value="373" {{ $user->cellphone_code == 373 ? 'selected' : '' }}>Moldova (+373)</option>
										<option data-countryCode="MC" value="377" {{ $user->cellphone_code == 377 ? 'selected' : '' }}>Monaco (+377)</option>
										<option data-countryCode="MN" value="976" {{ $user->cellphone_code == 976 ? 'selected' : '' }}>Mongolia (+976)</option>
										<option data-countryCode="MS" value="1664 {{ $user->cellphone_code == 1664 ? 'selected' : '' }}">Montserrat (+1664)</option>
										<option data-countryCode="MA" value="212" {{ $user->cellphone_code == 212 ? 'selected' : '' }}>Morocco (+212)</option>
										<option data-countryCode="MZ" value="258" {{ $user->cellphone_code == 258 ? 'selected' : '' }}>Mozambique (+258)</option>
										<option data-countryCode="MN" value="95" {{ $user->cellphone_code == 95 ? 'selected' : '' }}>Myanmar (+95)</option>
										<option data-countryCode="NA" value="264" {{ $user->cellphone_code == 264 ? 'selected' : '' }}>Namibia (+264)</option>
										<option data-countryCode="NR" value="674" {{ $user->cellphone_code == 674 ? 'selected' : '' }}>Nauru (+674)</option>
										<option data-countryCode="NP" value="977" {{ $user->cellphone_code == 977 ? 'selected' : '' }}>Nepal (+977)</option>
										<option data-countryCode="NL" value="31" {{ $user->cellphone_code == 31 ? 'selected' : '' }}>Netherlands (+31)</option>
										<option data-countryCode="NC" value="687" {{ $user->cellphone_code == 687 ? 'selected' : '' }}>New Caledonia (+687)</option>
										<option data-countryCode="NZ" value="64" {{ $user->cellphone_code == 64 ? 'selected' : '' }}>New Zealand (+64)</option>
										<option data-countryCode="NI" value="505" {{ $user->cellphone_code == 505 ? 'selected' : '' }}>Nicaragua (+505)</option>
										<option data-countryCode="NE" value="227" {{ $user->cellphone_code == 227 ? 'selected' : '' }}>Niger (+227)</option>
										<option data-countryCode="NG" value="234" {{ $user->cellphone_code == 234 ? 'selected' : '' }}>Nigeria (+234)</option>
										<option data-countryCode="NU" value="683" {{ $user->cellphone_code == 683 ? 'selected' : '' }}>Niue (+683)</option>
										<option data-countryCode="NF" value="672" {{ $user->cellphone_code == 672 ? 'selected' : '' }}>Norfolk Islands (+672)</option>
										<option data-countryCode="NP" value="670" {{ $user->cellphone_code == 670 ? 'selected' : '' }}>Northern Marianas (+670)</option>
										<option data-countryCode="NO" value="47" {{ $user->cellphone_code == 47 ? 'selected' : '' }}>Norway (+47)</option>
										<option data-countryCode="OM" value="968" {{ $user->cellphone_code == 968 ? 'selected' : '' }}>Oman (+968)</option>
										<option data-countryCode="PW" value="680" {{ $user->cellphone_code == 680 ? 'selected' : '' }}>Palau (+680)</option>
										<option data-countryCode="PA" value="507" {{ $user->cellphone_code == 507 ? 'selected' : '' }}>Panama (+507)</option>
										<option data-countryCode="PG" value="675" {{ $user->cellphone_code == 675 ? 'selected' : '' }}>Papua New Guinea (+675)</option>
										<option data-countryCode="PY" value="595" {{ $user->cellphone_code == 595 ? 'selected' : '' }}>Paraguay (+595)</option>
										<option data-countryCode="PE" value="51" {{ $user->cellphone_code == 51 ? 'selected' : '' }}>Peru (+51)</option>
										<option data-countryCode="PH" value="63" {{ $user->cellphone_code == 63 ? 'selected' : '' }}>Philippines (+63)</option>
										<option data-countryCode="PL" value="48" {{ $user->cellphone_code == 48 ? 'selected' : '' }}>Poland (+48)</option>
										<option data-countryCode="PT" value="351" {{ $user->cellphone_code == 351 ? 'selected' : '' }}>Portugal (+351)</option>
										<option data-countryCode="PR" value="1787" {{ $user->cellphone_code == 1787 ? 'selected' : '' }}>Puerto Rico (+1787)</option>
										<option data-countryCode="QA" value="974" {{ $user->cellphone_code == 974 ? 'selected' : '' }}>Qatar (+974)</option>
										<option data-countryCode="RE" value="262" {{ $user->cellphone_code == 262 ? 'selected' : '' }}>Reunion (+262)</option>
										<option data-countryCode="RO" value="40" {{ $user->cellphone_code == 40 ? 'selected' : '' }}>Romania (+40)</option>
										<option data-countryCode="RU" value="7" {{ $user->cellphone_code == 7 ? 'selected' : '' }}>Russia (+7)</option>
										<option data-countryCode="RW" value="250" {{ $user->cellphone_code == 250 ? 'selected' : '' }}>Rwanda (+250)</option>
										<option data-countryCode="SM" value="378" {{ $user->cellphone_code == 378 ? 'selected' : '' }}>San Marino (+378)</option>
										<option data-countryCode="ST" value="239" {{ $user->cellphone_code == 239 ? 'selected' : '' }}>Sao Tome &amp; Principe (+239)</option>
										<option data-countryCode="SA" value="966" {{ $user->cellphone_code == 966 ? 'selected' : '' }}>Saudi Arabia (+966)</option>
										<option data-countryCode="SN" value="221" {{ $user->cellphone_code == 221 ? 'selected' : '' }}>Senegal (+221)</option>
										<option data-countryCode="CS" value="381" {{ $user->cellphone_code == 381 ? 'selected' : '' }}>Serbia (+381)</option>
										<option data-countryCode="SC" value="248" {{ $user->cellphone_code == 248 ? 'selected' : '' }}>Seychelles (+248)</option>
										<option data-countryCode="SL" value="232" {{ $user->cellphone_code == 232 ? 'selected' : '' }}>Sierra Leone (+232)</option>
										<option data-countryCode="SG" value="65" {{ $user->cellphone_code == 65 ? 'selected' : '' }}>Singapore (+65)</option>
										<option data-countryCode="SK" value="421" {{ $user->cellphone_code == 421 ? 'selected' : '' }}>Slovak Republic (+421)</option>
										<option data-countryCode="SI" value="386" {{ $user->cellphone_code == 386 ? 'selected' : '' }}>Slovenia (+386)</option>
										<option data-countryCode="SB" value="677" {{ $user->cellphone_code == 677 ? 'selected' : '' }}>Solomon Islands (+677)</option>
										<option data-countryCode="SO" value="252" {{ $user->cellphone_code == 252 ? 'selected' : '' }}>Somalia (+252)</option>
										<option data-countryCode="ZA" value="27" {{ $user->cellphone_code == 27 ? 'selected' : '' }}>South Africa (+27)</option>
										<option data-countryCode="ES" value="34" {{ $user->cellphone_code == 34 ? 'selected' : '' }}>Spain (+34)</option>
										<option data-countryCode="LK" value="94" {{ $user->cellphone_code == 94 ? 'selected' : '' }}>Sri Lanka (+94)</option>
										<option data-countryCode="SH" value="290" {{ $user->cellphone_code == 290 ? 'selected' : '' }}>St. Helena (+290)</option>
										<option data-countryCode="KN" value="1869" {{ $user->cellphone_code == 1869 ? 'selected' : '' }}>St. Kitts (+1869)</option>
										<option data-countryCode="SC" value="1758" {{ $user->cellphone_code == 1758 ? 'selected' : '' }}>St. Lucia (+1758)</option>
										<option data-countryCode="SD" value="249" {{ $user->cellphone_code == 249 ? 'selected' : '' }}>Sudan (+249)</option>
										<option data-countryCode="SR" value="597" {{ $user->cellphone_code == 597 ? 'selected' : '' }}>Suriname (+597)</option>
										<option data-countryCode="SZ" value="268" {{ $user->cellphone_code == 268 ? 'selected' : '' }}>Swaziland (+268)</option>
										<option data-countryCode="SE" value="46" {{ $user->cellphone_code == 46 ? 'selected' : '' }}>Sweden (+46)</option>
										<option data-countryCode="CH" value="41" {{ $user->cellphone_code == 41 ? 'selected' : '' }}>Switzerland (+41)</option>
										<option data-countryCode="SI" value="963" {{ $user->cellphone_code == 963 ? 'selected' : '' }}>Syria (+963)</option>
										<option data-countryCode="TW" value="886" {{ $user->cellphone_code == 886 ? 'selected' : '' }}>Taiwan (+886)</option>
										<option data-countryCode="TJ" value="7" {{ $user->cellphone_code == 7 ? 'selected' : '' }}>Tajikstan (+7)</option>
										<option data-countryCode="TH" value="66" {{ $user->cellphone_code == 66 ? 'selected' : '' }}>Thailand (+66)</option>
										<option data-countryCode="TG" value="228" {{ $user->cellphone_code == 228 ? 'selected' : '' }}>Togo (+228)</option>
										<option data-countryCode="TO" value="676" {{ $user->cellphone_code == 676 ? 'selected' : '' }}>Tonga (+676)</option>
										<option data-countryCode="TT" value="1868" {{ $user->cellphone_code == 1868 ? 'selected' : '' }}>Trinidad &amp; Tobago (+1868)</option>
										<option data-countryCode="TN" value="216" {{ $user->cellphone_code == 216 ? 'selected' : '' }}>Tunisia (+216)</option>
										<option data-countryCode="TR" value="90" {{ $user->cellphone_code == 90 ? 'selected' : '' }}>Turkey (+90)</option>
										<option data-countryCode="TM" value="993" {{ $user->cellphone_code == 993 ? 'selected' : '' }}>Turkmenistan (+993)</option>
										<option data-countryCode="TC" value="1649" {{ $user->cellphone_code == 1649 ? 'selected' : '' }}>Turks &amp; Caicos Islands (+1649)</option>
										<option data-countryCode="TV" value="688" {{ $user->cellphone_code == 688 ? 'selected' : '' }}>Tuvalu (+688)</option>
										<option data-countryCode="UG" value="256" {{ $user->cellphone_code == 256 ? 'selected' : '' }}>Uganda (+256)</option>
										<option data-countryCode="UA" value="380" {{ $user->cellphone_code == 380 ? 'selected' : '' }}>Ukraine (+380)</option>
										<option data-countryCode="AE" value="971" {{ $user->cellphone_code == 971 ? 'selected' : '' }}>United Arab Emirates (+971)</option>
										<option data-countryCode="UY" value="598" {{ $user->cellphone_code == 598 ? 'selected' : '' }}>Uruguay (+598)</option>
										<option data-countryCode="UZ" value="7" {{ $user->cellphone_code == 7 ? 'selected' : '' }}>Uzbekistan (+7)</option>
										<option data-countryCode="VU" value="678" {{ $user->cellphone_code == 678 ? 'selected' : '' }}>Vanuatu (+678)</option>
										<option data-countryCode="VA" value="379" {{ $user->cellphone_code == 379 ? 'selected' : '' }}>Vatican City (+379)</option>
										<option data-countryCode="VE" value="58" {{ $user->cellphone_code == 58 ? 'selected' : '' }}>Venezuela (+58)</option>
										<option data-countryCode="VN" value="84" {{ $user->cellphone_code == 84 ? 'selected' : '' }}>Vietnam (+84)</option>
										<option data-countryCode="VG" value="1284" {{ $user->cellphone_code == 1284 ? 'selected' : '' }}>Virgin Islands - British (+1284)</option>
										<option data-countryCode="VI" value="1340" {{ $user->cellphone_code == 1340 ? 'selected' : '' }}>Virgin Islands - US (+1340)</option>
										<option data-countryCode="WF" value="681" {{ $user->cellphone_code == 681 ? 'selected' : '' }}>Wallis &amp; Futuna (+681)</option>
										<option data-countryCode="YE" value="969" {{ $user->cellphone_code == 969 ? 'selected' : '' }}>Yemen (North)(+969)</option>
										<option data-countryCode="YE" value="967" {{ $user->cellphone_code == 967 ? 'selected' : '' }}>Yemen (South)(+967)</option>
										<option data-countryCode="ZM" value="260" {{ $user->cellphone_code == 260 ? 'selected' : '' }}>Zambia (+260)</option>
										<option data-countryCode="ZW" value="263" {{ $user->cellphone_code == 263 ? 'selected' : '' }}>Zimbabwe (+263)</option>
									</select>
									<input name="cellphone" class="form-control @error('cellphone') is-invalid @enderror offset-1 col-md-6 col-sm-12" value="{{ $user->cellphone }}" required>
								</div>
								@if($errors->has('cellphone'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('cellphone') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-2 col-sm-12 col-form-label text-right">{{ trans('global.Password') }}</label>
							<div class="col-md-10 col-sm-12">
								<input name="password" class="form-control @error('password') is-invalid @enderror" type="password">
								@if($errors->has('password'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="text-right">
							<button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection