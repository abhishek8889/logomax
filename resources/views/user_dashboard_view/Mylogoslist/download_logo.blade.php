@extends('user_dashboard_layout.master_layout')
@section('content')
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abhaya+Libre|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akaya+Kanadaka|Akaya+Telivigala|Akronim|Aladin|Alata|Alatsi|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Aleo|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almarai|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Amiko|Amiri|Amita|Anaheim|Andada|Andika|Andika+New+Basic|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Antonio|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo|Archivo+Black|Archivo+Narrow|Aref+Ruqaa|Arima+Madurai|Arimo|Arizonia|Armata|Arsenal|Artifika|Arvo|Arya|Asap|Asap+Condensed|Asar|Asset|Assistant|Astloch|Asul|Athiti|Atma|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|B612|B612+Mono|Bad+Script|Bahiana|Bahianita|Bai+Jamjuree|Ballet|Baloo+2|Baloo+Bhai+2|Baloo+Bhaina+2|Baloo+Chettan+2|Baloo+Da+2|Baloo+Paaji+2|Baloo+Tamma+2|Baloo+Tammudu+2|Baloo+Thambi+2|Balsamiq+Sans|Balthazar|Bangers|Barlow|Barlow+Condensed|Barlow+Semi+Condensed|Barriecito|Barrio|Basic|Baskervville|Battambang|Baumans|Bayon|Be+Vietnam|Bebas+Neue|Belgrano|Bellefair|Belleza|Bellota|Bellota+Text|BenchNine|Benne|Bentham|Berkshire+Swash|Beth+Ellen|Bevan|Big+Shoulders+Display|Big+Shoulders+Inline+Display|Big+Shoulders+Inline+Text|Big+Shoulders+Stencil+Display|Big+Shoulders+Stencil+Text|Big+Shoulders+Text|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|BioRhyme|BioRhyme+Expanded|Biryani|Bitter|Black+And+White+Picture|Black+Han+Sans|Black+Ops+One|Blinker|Bodoni+Moda|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Brygada+1918|Bubblegum+Sans|Bubbler+One|Buda|Buenard|Bungee|Bungee+Hairline|Bungee+Inline|Bungee+Outline|Bungee+Shade|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Cairo|Caladea|Calistoga|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Castoro|Catamaran|Caudex|Caveat|Caveat+Brush|Cedarville+Cursive|Ceviche+One|Chakra+Petch|Changa|Changa+One|Chango|Charm|Charmonman|Chathura|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chilanka|Chivo|Chonburi|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption|Codystar|Coiny|Combo|Comfortaa|Comic+Neue|Coming+Soon|Commissioner|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Cormorant|Cormorant+Garamond|Cormorant+Infant|Cormorant+SC|Cormorant+Unicase|Cormorant+Upright|Courgette|Courier+Prime|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Pro|Crimson+Text|Croissant+One|Crushed|Cuprum|Cute+Font|Cutive|Cutive+Mono|DM+Mono|DM+Sans|DM+Serif+Display|DM+Serif+Text|Damion|Dancing+Script|Dangrek|Darker+Grotesque|David+Libre|Dawning+of+a+New+Day|Days+One|Dekko|Dela+Gothic+One|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Do+Hyeon|Dokdo|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|DotGothic16|Dr+Sugiyama|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|East+Sea+Dokdo|Eater|Economica|Eczar|El+Messiri|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Encode+Sans|Encode+Sans+Condensed|Encode+Sans+Expanded|Encode+Sans+Semi+Condensed|Encode+Sans+Semi+Expanded|Engagement|Englebert|Enriqueta|Epilogue|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Exo+2|Expletus+Sans|Fahkwang|Fanwood+Text|Farro|Farsan|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Faustina|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Code|Fira+Mono|Fira+Sans|Fira+Sans+Condensed|Fira+Sans+Extra+Condensed|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Frank+Ruhl+Libre|Fraunces|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gaegu|Gafata|Galada|Galdeano|Galindo|Gamja+Flower|Gayathri|Gelasio|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Girassol|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Goldman|Gorditas|Gothic+A1|Gotu|Goudy+Bookletter+1911|Graduate|Grand+Hotel|Grandstander|Gravitas+One|Great+Vibes|Grenze|Grenze+Gotisch|Griffy|Gruppo|Gudea|Gugi|Gupter|Gurajada|Habibi|Hachi+Maru+Pop|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Harmattan|Headland+One|Heebo|Henny+Penny|Hepta+Slab|Herr+Von+Muellerhoff|Hi+Melody|Hind|Hind+Guntur|Hind+Madurai|Hind+Siliguri|Hind+Vadodara|Holtwood+One+SC|Homemade+Apple|Homenaje|IBM+Plex+Mono|IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Ibarra+Real+Nova|Iceberg|Iceland|Imbue|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Inknut+Antiqua|Inria+Sans|Inria+Serif|Inter|Irish+Grover|Istok+Web|Italiana|Italianno|Itim|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|JetBrains+Mono|Jim+Nightshade|Jockey+One|Jolly+Lodger|Jomhuria|Jomolhari|Josefin+Sans|Josefin+Slab|Jost|Joti+One|Jua|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|K2D|Kadwa|Kalam|Kameron|Kanit|Kantumruy|Karantina|Karla|Karma|Katibeh|Kaushan+Script|Kavivanar|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kirang+Haerang|Kite+One|Kiwi+Maru|Knewave|KoHo|Kodchasan|Kosugi|Kosugi+Maru|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Krub|Kufam|Kulim+Park|Kumar+One|Kumar+One+Outline|Kumbh+Sans|Kurale|La+Belle+Aurore|Lacquer|Laila|Lakki+Reddy|Lalezar|Lancelot|Langar|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Lemonada|Lexend|Lexend+Deca|Lexend+Exa|Lexend+Giga|Lexend+Mega|Lexend+Peta|Lexend+Tera|Lexend+Zetta|Libre+Barcode+128|Libre+Barcode+128+Text|Libre+Barcode+39|Libre+Barcode+39+Extended|Libre+Barcode+39+Extended+Text|Libre+Barcode+39+Text|Libre+Barcode+EAN13+Text|Libre+Baskerville|Libre+Caslon+Display|Libre+Caslon+Text|Libre+Franklin|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Literata|Liu+Jian+Mao+Cao|Livvic|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Long+Cang|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|M+PLUS+1p|M+PLUS+Rounded+1c|Ma+Shan+Zheng|Macondo|Macondo+Swash+Caps|Mada|Magra|Maiden+Orange|Maitree|Major+Mono+Display|Mako|Mali|Mallanna|Mandali|Manjari|Manrope|Mansalva|Manuale|Marcellus|Marcellus+SC|Marck+Script|Margarine|Markazi+Text|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Meera+Inimai|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Mina|Miniver|Miriam+Libre|Mirza|Miss+Fajardose|Mitr|Modak|Modern+Antiqua|Mogra|Molengo|Molle|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Mukta|Mukta+Mahee|Mukta+Malar|Mukta+Vaani|Mulish|MuseoModerno|Mystery+Quest|NTR|Nanum+Brush+Script|Nanum+Gothic|Nanum+Gothic+Coding|Nanum+Myeongjo|Nanum+Pen+Script|Nerko+One|Neucha|Neuton|New+Rocker|New+Tegomin|News+Cycle|Newsreader|Niconne|Niramit|Nixie+One|Nobile|Nokora|Norican|Nosifer|Notable|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Sans+Gurmukhi|Noto+Sans+HK|Noto+Sans+JP|Noto+Sans+KR|Noto+Sans+SC|Noto+Sans+TC|Noto+Serif|Noto+Serif+JP|Noto+Serif+KR|Noto+Serif+SC|Noto+Serif+TC|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Nunito+Sans|Odibee+Sans|Odor+Mean+Chey|Offside|Oi|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed|Oranienbaum|Orbitron|Oregano|Orelega+One|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Overpass|Overpass+Mono|Ovo|Oxanium|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Padauk|Palanquin|Palanquin+Dark|Pangolin|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Pattaya|Patua+One|Pavanam|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piazzolla|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poor+Story|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Potta+One|Pragati+Narrow|Prata|Preahvihear|Press+Start+2P|Pridi|Princess+Sofia|Prociono|Prompt|Prosto+One|Proza+Libre|Public+Sans|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Rakkas|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rasa|Rationale|Ravi+Prakash|Recursive|Red+Hat+Display|Red+Hat+Text|Red+Rose|Redressed|Reem+Kufi|Reenie+Beanie|Reggae+One|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|RocknRoll+One|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rowdies|Rozha+One|Rubik|Rubik+Mono+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Saira|Saira+Condensed|Saira+Extra+Condensed|Saira+Semi+Condensed|Saira+Stencil+One|Salsa|Sanchez|Sancreek|Sansita|Sansita+Swashed|Sarabun|Sarala|Sarina|Sarpanch|Satisfy|Sawarabi+Gothic|Sawarabi+Mincho|Scada|Scheherazade|Schoolbell|Scope+One|Seaweed+Script|Secular+One|Sedgwick+Ave|Sedgwick+Ave+Display|Sen|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shippori+Mincho|Shippori+Mincho+B1|Shojumaru|Short+Stack|Shrikhand|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Single+Day|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slabo+13px|Slabo+27px|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Solway|Song+Myung|Sonsie+One|Sora|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Space+Grotesk|Space+Mono|Spartan|Special+Elite|Spectral|Spectral+SC|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Sriracha|Srisakdi|Staatliches|Stalemate|Stalinist+One|Stardos+Stencil|Stick|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Stylish|Sue+Ellen+Francisco|Suez+One|Sulphur+Point|Sumana|Sunflower|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Syne|Syne+Mono|Syne+Tactile|Tajawal|Tangerine|Taprom|Tauri|Taviraj|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|Texturina|Thasadith|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Tomorrow|Trade+Winds|Train+One|Trirong|Trispace|Trocchi|Trochut|Truculenta|Trykker|Tulpen+One|Turret+Road|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Varta|Vast+Shadow|Vesper+Libre|Viaoda+Libre|Vibes|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Vollkorn+SC|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Work+Sans|Xanh+Mono|Yanone+Kaffeesatz|Yantramanav|Yatra+One|Yellowtail|Yeon+Sung|Yeseva+One|Yesteryear|Yrsa|Yusei+Magic|ZCOOL+KuaiLe|ZCOOL+QingKe+HuangYou|ZCOOL+XiaoWei|Zen+Dots|Zeyada|Zhi+Mang+Xing|Zilla+Slab|Zilla+Slab+Highlight"> -->
<style>
    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .loader img{
        max-width: 120px;
    }
    .loader-box {
        display:none;
        width: 100%;
        height: 100%;
        background: #000;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100000;
        opacity: 72%;
    }

    .approval-btn {
        display: flex;
        margin-top: 25px;
        gap: 10px;
    /* justify-content: center; */
    }

    /* .load-btn {
        text-align: center;
    } */
    .load-btn a {
        display:inline-block;
    }
    .download-btn-head i.fas.fa-file-download {
        color: black;
    }

    #chatBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px;
        /* background-color: #007bff; */
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius:50%;
        z-index:999999;
    }
</style>

<div class="loader-box">
    <div class="loader"><img src="{{ asset('logomax-front-asset/img/loading-loading-forever.gif') }}" alt=""></div>
</div>
<section class="logo-detail-sec download_sec">
    <div class="container">
        <?php 
            $media = App\Models\Media::class;
            $mediaObj = $media::find($orderDetail->logodetail->media_id);
            $image_name = $mediaObj->image_name;
            if($mediaObj->directory_name != null || $mediaObj->directory_name != ""){
                $image_url = asset('LogoDirectory/'.$mediaObj->directory_name.'/'.$mediaObj->directory_name.'.png');
            }else{
                $image_url = asset($mediaObj->image_path);
            }
        ?>
        
        <div class="logo_wrapper download_page">
            <div class="row">
                <div class="col-md-6">
                    <div class="vita-img ">
                        <img class="img-fluid" src="{{ $image_url }}" alt="{{ $image_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="template_data">
                       <div class="hand_text">
                            <h4>{{ $orderDetail->logodetail->logo_name ?? ''; }}
                                <!-- <a href="" order-id="{{ $orderDetail->id ?? '' }}"  class="download-btn-head">
                                    <i class="fas fa-file-download"></i>
                                </a> -->
                            </h4>
                       </div>
                        <!-- Download Button and revision status -->
                        <div class="cta_wrapp arrow-ct"> 
                        @if($orderDetail->on_revision == 0)
                            <div class="load-btn free">
                                <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="logo" class="request-btn btn cta">Request Logo Revision</a>
                            </div>
                        @else
                            @if(!empty($lastRevisionLogo->status))
                                @if( $lastRevisionLogo->status == 0)
                                    <div class="load-btn free">
                                        <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="logo" class="request-btn btn cta">Request Logo Revision</a>
                                    </div>
                                @elseif(isset($lastRevisionLogo->status) && $lastRevisionLogo->status == 1)
                                    <div class="load-btn free">
                                        <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="logo" class="request-btn btn cta">Request Logo Revision</a>
                                    </div>
                                @elseif(isset($lastRevisionLogo->status) && $lastRevisionLogo->status == 2)
                                    <div class="load-btn niks-lod-btn">
                                        <a href="{{ url(app()->getLocale().'/downloadProcess/'.$lastRevisionLogo->id) }}" order-id="{{ $orderDetail->id ?? '' }}" class="download-btn btn cta" id="download_revised_logo">
                                            <i class="fa-solid fa-download"></i>
                                            Download Logo
                                        </a>
                                        <div class="niks-download">
                                            <a href="javascript:void(0)" class="btn cta drop-ico">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </a>
                                            <!-- Approve and disapprove favicon button -->
                                            <div class="approval-btn niks-approval">
                                                <div class="load-btn free">
                                                    <a href="{{ url(app()->getLocale().'/approve-logo/'.$lastRevisionLogo->id) }}" class="resp_btn  btn cta">
                                                        Approve Logo
                                                    </a>
                                                </div>
                                                <div class="load-btn mr-2">
                                                    <a href="{{ url(app()->getLocale().'/disapprove-logo/'.$lastRevisionLogo->id) }}" class="resp_btn  btn cta">
                                                        Disapprove Logo
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- End -->
                                        </div>
                                    </div>
                                    
                                @endif
                            @else 
                                <div class="load-btn free">
                                    <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="logo" class="request-btn btn cta">Request Logo Revision</a>
                                </div>
                            @endif
                        @endif
                     
                        @if($orderDetail->get_favicon_status == 1)
                            @if(!empty($lastRevisionFavicon))
                                @if($lastRevisionFavicon->status == 0)
                                    <div class="load-btn free">
                                        <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="favicon" class="request-btn  btn cta">Request favicon revision</a>
                                    </div>
                                @elseif($lastRevisionFavicon->status == 1)
                                    <div class="load-btn free">
                                        <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" type="favicon" class="request-btn  btn cta">Request favicon revision</a>
                                    </div>
                                   
                                @elseif($lastRevisionFavicon->status == 2)
                                    <div class="load-btn niks-lod-btn">
                                        <a href="{{ url(app()->getLocale().'/downloadProcess/'.$lastRevisionFavicon->id) }}?ysdfsd" order-id="{{ $orderDetail->id ?? '' }}" class="download-btn  btn cta" id="download_revised_logo">
                                            <i class="fa-solid fa-download"></i>
                                            Download Favicon
                                        </a>
                                        <div class="niks-download">
                                            <a href="javascript:void(0)" class="btn cta drop-ico">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </a>
                                            <!-- Approve and disapprove favicon button -->
                                            <div class="approval-btn niks-approval">
                                                <div class="load-btn free">
                                                    <a href="{{ url(app()->getLocale().'/approve-logo/'.$lastRevisionFavicon->id) }}" class="resp_btn  btn cta">
                                                        Approve
                                                    </a>
                                                </div>
                                                <div class="load-btn mr-2">
                                                    <a href="{{ url(app()->getLocale().'/disapprove-logo/'.$lastRevisionFavicon->id) }}" class="resp_btn  btn cta">
                                                        Disapprove
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- End -->
                                        </div>
                                    </div>
                                    
                                @endif
                            @endif
                        @endif

                        @if($orderDetail->on_revision == 1 )
                            <div class="load-btn" id="chatBtn">
                                <a href="{{ url(app()->getLocale().'/user-dashboard/messages/'.base64_encode($lastRevision_user_favicon->email ?? $lastRevision_user_favicon->email )) }}" class="btn cta"><i class="fa-regular fa-comment-dots"></i></a>
                            </div>
                        @endif
                        </div> 
                        <div class="order-detail-niks">
                            <a  class="btn cta" href="{{ url(app()->getLocale().'/order-details/'.$orderDetail->order_num) }}">see order detail</a>
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Revision request modal  -->
    <div class="modal fade" id="revisionRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <div>
                <h5 class="modal-title text text-dark" id="exampleModalLabel">Enter Your Revision Request . </h5>
                <!-- <p class="text text-secondary">We can change only color, text and fonts.</p> -->
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="customization-form" method="post" id="customization-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $orderDetail->id ?? '' }}">
                <input type="hidden" name="type" id="revision_type" value=""/>
                <input type="hidden" name="availableRevisionID" value="{{ $availableRevisionID ?? '' }}" />
                <div class="form-group">
                    <label for="company_name" class="col-form-label">Company Name<sup>*</sup></label>
                    <input type="text" class="form-control" name="company_name" id="company_name" />  
                    <span id="company_name_error" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="request_title" class="col-form-label">Subtitle<sup>*</sup></label>
                    <input type="text" class="form-control" name="request_subtitle" id="request_subtitle" />
                    <span id="title_error" class="text-danger"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="request_subtitle" class="col-form-label">Subtitle<sup>*</sup></label>
                    <input type="text" class="form-control" name="request_subtitle" id="request_subtitle" />
                    <span id="subtitle_error" class="text-danger"></span>
                </div> -->
                <div class="form-group ">
                    <label for="colors" class="col-form-label">Choose Color</label>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" class="form-control colorpicker" name="colors" id="colors" />
                        </div>
                        <div class="btn btn-primary" id="save-color" style="display:none;">save</div>
                    </div>
                    <div class=""  id="selected-color-box">
                   
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="fonts" class="col-form-label">Fonts</label>

                    <select name="fonts[]"  class="form-control" id="font_name">

                    </select>
                    <div class=""  id="selected-fonts-box">
                   
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="file" class="col-form-label">Upload file</label>
                    <input type="file" class="" name="file" id="file">
                </div>
                <div class="form-group">
                    <label for="request_desc" class="col-form-label">Description<sup>*</sup></label>
                    <textarea class="form-control" name="request_description" id="request_desc"></textarea>
                    <span id="desc_error" class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-primary">Send Request</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
        </div>
    </div>
    </div>
<!-- End -->


<!-- Favicon Revision request modal  -->

<!-- End -->

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('user-dashboard/directmessagesProcc') }}" method="post">
            @csrf
            <input type="hidden" name="sender_id" value="{{ auth()->user()->id ?? '' }}">
            <input type="hidden" name="reciever_id" value="{{ $lastRevisionLogo->assigned_designer_id ?? '' }}">
            <div class="form-group">
                <textarea name="message" id="message" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
    use Carbon\Carbon;
    $orderMakeAt = $orderDetail->created_at;
    $dateObj = Carbon::parse($orderMakeAt);
    
    $currentDate = Carbon::now()->format('Y-m-d H:i:s');
    $downloadUptoDayLimit = 30 ;  //days 
    $logoBackupResponse = [];
    // dd($orderDetail);
    if($orderDetail->logo_for_future_status == 1){
        // dd($currentDate , $dateObj);
        $logoBackupResponse = [
            'status' => true,
            'type' => 'paid_service',
            'message' => '',
        ];

        $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);
        $dateObj3 = Carbon::parse($orderMakeAt);
        $checkRenewDateStatus  = $dateObj3->addDays($downloadUptoDayLimit + 30);
       
        if($checkRenewDateStatus > $currentDate ){
            // One month is over after order now checking the further more payments .
            $renewUpto = $checkRenewDateStatus->format('Y-m-d');
            
            if($donwloadUpTo < $currentDate){
                
                $logoBackupResponse = [
                    'status' => false,
                    'type' => 'paid_service',
                    'removed' => false,
                    'message' => "Your logo backup service has expired. Renew before $renewUpto to avoid service removal. Act now to continue enjoying our backup benefits. Thank you!",
                ];

                $paymentData = App\Models\Payment::where([['order_id','=',$orderDetail->id],['payment_type','=','logo-backup']])->latest()->first();

                if($paymentData){
                    $dateObj2 = Carbon::parse($paymentData->created_at);
                    $paymentDurValidUpto = $dateObj2->addDays($downloadUptoDayLimit);
                    if($paymentDurValidUpto > $currentDate){
                        $logoBackupResponse = [
                            'status' => true,
                            'type' => 'paid_service',
                            'removed' => false,
                            'message' => '',
                        ];
                    }
                }
            }else{
                $logoBackupResponse = [
                    'status' => true,
                    'type' => 'paid_service',
                    'removed' => false,
                    'message' => "",
                ];
            }

        }else{

            $logoBackupResponse = [
                'status' => false,
                'type' => 'paid_service',
                'removed' => true,
                'message' => "You have not renewed your logo backup service in given time, and as a result, it has been deleted.",
            ];

        }

    }else{

        $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);

        if($donwloadUpTo < $currentDate){
            // One month is over after order now and now no backup is there.
            $logoBackupResponse = [
                'status' => false,
                'type' => 'free_service',
                'removed' => true,
                'message' => 'Your free logo backup service is over now .',
            ];
        }else{
            $logoBackupResponse = [
                'status' => true,
                'type' => 'free_service',
                'removed' => false,
                'message' => '',
            ];
        }

    }
    // dd($logoBackupResponse);
   
    $uriArr = [
        'order_id' => $orderDetail->id,
        'availableRevisionID' => $availableRevisionID,
        'availableFaviconRevisionID' => $availableFaviconRevisionID,
    ];

   

    $uriParam = base64_encode(urlencode(json_encode($uriArr)));
   
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $('.colorpicker').colorpicker();
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let canSendRequest = false;
    let count  = 0 ;

    ////////////////////////////////// Revision request functionality ///////////////////////////////
    $(".request-btn").on('click',function(e){
        e.preventDefault();
        let revisionType = $(this).attr('type');
        $("#revision_type").val(revisionType);

        /////////////////////////  While clicking on logo revision ///////////////////////

        if(revisionType == 'logo'){
            @if($orderDetail->on_revision == 1 && $logoOnRevisionStatus == true)

                Swal.fire({
                    icon: 'error',
                    title: 'Your logo is already on revision.',
                    footer: 'Please wait we have provide your logo as soon as possible !'
                });

            @else
                @if($revisionAllowed !== true)
                    Swal.fire({
                        title: "Need to Pay.",
                        text: "Your free revision request is over now you have to pay $39 USD for addition revision request.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ok i'll pay"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href= "{{ url(app()->getLocale().'/payments/logo_revision/'.$orderDetail->order_num) }}";  
                            }
                        });
                @else
                    window.location.href=" {{ url(app()->getLocale().'/revision/logo_revision?detail='.$uriParam) }} ";
                    // $("#revisionRequestModal").modal('show');
                    // // /send request new code
                
                    // $('#customization-form').on('submit',function(e){
                    //     e.preventDefault();
                    //     // console.log(' before if canSendRequest  -> ' + canSendRequest);
                    //     if (canSendRequest) {
                    //         return;
                    //     }
                    //     // console.log(' after if canSendRequest  -> ' + canSendRequest);
                        
                    //     $('#company_name_error').html('');
                    //     $('#title_error').html('');
                    //     $('#desc_error').html('');
                    //     formdata = new FormData(this);
                    //     company_name = $('input[name="company_name"]').val();
                    //     title = $('input[name="request_subtitle"]').val();
                    //     description = $('textarea[name="request_description"]').val();
                        
                    //     if(company_name == "" || company_name == null){
                    //         $('#company_name_error').html('Company name is required.');
                    //         return false;
                    //     }
                    //     if(title == "" || title == null){
                    //         $('#title_error').html('Subtitle is required.');
                    //         return false;
                    //     }
                    //     if(description == "" || description == null){
                    //         $('#desc_error').html('Description is required.');
                    //         return false;
                    //     }
                    //     $(".loader-box").show();

                    //     canSendRequest = true;
                    
                    //     $.ajax({
                    //         method: 'post',
                    //         url: '{{url(app()->getlocale().'/request-for-revision')}}',
                    //         data: formdata,
                    //         dataType: 'json',
                    //         contentType: false,
                    //         processData: false,
                    //         success: function(response)
                    //         {
                    //             setTimeout(()=>{
                    //             $(".loader-box").hide();
                    //             Swal.fire(
                    //                         response.title,
                    //                         response.message,
                    //                         response.status_title
                    //                     ).then((result) => {
                    //                         if (result.isConfirmed) {
                    //                             location.reload();
                    //                         }
                    //                 });
                    //             }, 1000);
                    //             canSendRequest = false;
                    //         }
                    //     });
                    // });
                @endif
            @endif
        }

        ///////////////////////////////////////  END  ///////////////////////////////////////

      
        /////////////////////////  While clicking on favicon revision ///////////////////////
        @if($orderDetail->get_favicon_status == 1)
        if(revisionType == 'favicon'){

            @if($orderDetail->on_revision == 1 && $faviconOnRevisionStatus == true)

                Swal.fire({
                    icon: 'error',
                    title: 'Your Favicon is already on revision.',
                    footer: 'Please wait we have provide your favicon as soon as possible !'
                });

            @else
                @if($faviconRevisionAllowed['status'] !== true)
                    Swal.fire({
                        title: "{{ $faviconRevisionAllowed['title'] }}",
                        text: "{{ $faviconRevisionAllowed['message'] }}",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ok i'll pay"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href= "{{ url(app()->getLocale().'/payments/favicon_revision/'.$orderDetail->order_num) }}";  
                            }
                        });
                @else
                    window.location.href=" {{ url(app()->getLocale().'/revision/favicon_revision?detail='.$uriParam) }} ";
                @endif
            @endif
        }
        @endif
       ///////////////////////////////////////  END ////////////////////////////////////

        
    });

    ////////////////////////////////// END ///////////////////////////////////////

    $('.download-btn-head').on('click',function(e){
        e.preventDefault();
        order_id = $(this).attr('order-id');
        @if($logoBackupResponse['status'] == true)
            location.href = "{{ url(app()->getLocale().'/user-dashboard/logo/download') }}/"+order_id;
        @else
            @if($logoBackupResponse['type'] == 'free_service' || $logoBackupResponse['removed'] == true)
                Swal.fire({
                    title: "Logo is removed",
                    text: "{{ $logoBackupResponse['message'] }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    });
            @else
                Swal.fire({
                    title: "Need to Pay.",
                    text: "{{ $logoBackupResponse['message'] }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok i'll pay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href= "{{ url(app()->getLocale().'/payments/logo-backup/'.$orderDetail->order_num) }}";  
                        }
                    });
            @endif
        @endif   
    });

    $(document).ready(function(){
        let selectedColor = ''; 
        let selectedColorBox = $("#selected-color-box");
        $(".colorpicker").on('changeColor', function(e) {
            e.preventDefault();
            selectedColor = e.color.toString();
            $("#save-color").show();
        });

        $("#save-color").on('click', function(event) {
            event.preventDefault();
            let colorLimit  = 5 ;
            if($('#selected-color-box').find('.color-wrapper').length === colorLimit){
                if (selectedColorBox.find('.colorSelectLimit').length === 0) {
                    selectedColorBox.append(`<div class="text text-danger colorSelectLimit">You can select only ${colorLimit} colors.</div>`);
                }
                return false;
            }else{
                if (selectedColor !== '') {
                    if(selectedColorBox.find('.colorSelectLimit').length > 0){
                        selectedColorBox.find('.colorSelectLimit').remove();
                    }
                    let colorList = selectedColor.split('#');
                    let lastColor = `#${colorList[colorList.length - 1]}`;
                    let liElem = `<div class="color-wrapper"><div class="color-box" style="background:${lastColor}; height:10px; width:10px;"></div><div class="color-name"> ${lastColor} <input type="hidden" name="colors[]" value="${lastColor}" /><span class="unselect_color_code"><i class="fas fa-times"></i></span> </div></div>`;
                    console.log('length ->' + selectedColorBox.length);
                    selectedColorBox.append(liElem);
                }
            }
        });
    });

    $(document).on('click','.unselect_color_code',function(e){
        e.preventDefault();
        let selectedColorBox = $("#selected-color-box");
        if(selectedColorBox.find('.colorSelectLimit').length > 0){
            selectedColorBox.find('.colorSelectLimit').remove();
        }
        thisObj = $(this);
        thisObj.parents('.color-wrapper').remove();

    });

    $(document).on('click','.unselect_fonts',function(e){
        e.preventDefault();
        let selectedFontBox = $("#selected-fonts-box");
        if(selectedFontBox.find('.fontSelectLimit').length > 0){
            selectedFontBox.find('.fontSelectLimit').remove();
        }
        thisObj = $(this);
        thisObj.parents('.font-wrapper').remove();

    });

    $(document).on('change','#font_name',function(e){
        e.preventDefault();
        let thisObj = $(this).val();
        let fonts_box = $("#selected-fonts-box");
        let fontLimit = 3 ;
        if($('#selected-fonts-box').find('.font-wrapper').length === fontLimit){
            if (fonts_box.find('.fontSelectLimit').length === 0) {
                fonts_box.append(`<div class="text text-danger fontSelectLimit">You can select only ${fontLimit} fonts.</div>`);
            }
            return false;
        }else{
            let fontWrapHtml = `<div class="font-wrapper"><div class="font-name" style="font-family:${thisObj};"> ${thisObj} <input type="hidden" name="selectedFonts[]" value="${thisObj}" /><span class="unselect_fonts"><i class="fas fa-times"></i></span> </div></div>`;
            fonts_box.append(fontWrapHtml);
        }

    });
    const apiUrl = 'https://www.googleapis.com/webfonts/v1/webfonts?key={{ env("GOOGLE_FONT_API_KEY") }}';
    fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        const fontFamilies = data.items.map(font => font.family);
        $.each(fontFamilies,function(ind,val){
            $("#font_name").append(`<option value="${val}" style="font-family:${val};"> ${val}</option>`);
        });
    })
    .catch(error => console.error('Error fetching Google Fonts:', error));
</script>
@endsection