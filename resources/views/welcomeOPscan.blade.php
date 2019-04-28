    @extends('layouts.templateOPMaster')
    @section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

            <div class="block-header">
                <h2>Home</h2>
            </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">event</i>
                        </div>
                        <div class="content">
                            <div class="text">DATE NOW</div>
                            <div class="">{{ $tgl }}</div>
                        </div>
                    </div>
                </div>
            <!-- Vertical Layout -->
            <div class="row clearfix">
			
			<div class="col-lg-12">
					<div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SCAN QR CODE
                            </h2>
                        </div>
                        <div class="body">
							<b>Device has camera: </b>
									<span id="cam-has-camera"></span>
									<br>
									<video style="width:100%;" muted playsinline id="qr-video"></video>
								
								<b>Detected QR code: </b>
								<span id="cam-qr-result">None</span>
							
											
						</div>
						</div>
					</div>
						<div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PARKING
                            </h2>
                        </div>
                        <div class="body">
							
							
											
						</div>
						</div>
					</div>
                </div>
            </div>
		
			
								<script type="module">
									import QrScanner from "/assets/data_scanner/qr-scanner.min.js";
									QrScanner.WORKER_PATH = '/assets/data_scanner/qr-scanner-worker.min.js';

									const video = document.getElementById('qr-video');
									const camHasCamera = document.getElementById('cam-has-camera');
									const camQrResult = document.getElementById('cam-qr-result');
									const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
									const fileSelector = document.getElementById('file-selector');
									const fileQrResult = document.getElementById('file-qr-result');

									function setResult(label, result) {
										label.textContent = result;
										camQrResultTimestamp.textContent = new Date().toString();
										label.style.color = 'teal';
										clearTimeout(label.highlightTimeout);
										label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
									}

									// ####### Web Cam Scanning #######

									QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

									const scanner = new QrScanner(video, result => setResult(camQrResult, result));
									scanner.start();

									document.getElementById('inversion-mode-select').addEventListener('change', event => {
										scanner.setInversionMode(event.target.value);
									});

									// ####### File Scanning #######

									fileSelector.addEventListener('change', event => {
										const file = fileSelector.files[0];
										if (!file) {
											return;
										}
										QrScanner.scanImage(file)
											.then(result => setResult(fileQrResult, result))
											.catch(e => setResult(fileQrResult, e || 'No QR code found.'));
									});

								</script>	
        @endsection