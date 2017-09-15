<nav id="navigation">
	<div class="title">
		<a href="/?a=<?php echo $album; ?>">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 1800"><path d="M932.14 845.75q0-14.05-9.04-23.1-9.04-9.03-23.1-9.03-66.3 0-113.5 47.2-47.2 47.17-47.2 113.43 0 14.05 9.03 23.1 9.04 9.02 23.1 9.02 14.06 0 23.1-9.03 9.04-9.04 9.04-23.1 0-40.15 28.13-68.26 28.12-28.1 68.3-28.1 14.06 0 23.1-9.04 9.04-9.04 9.04-23.1zm225 130.5q0 106.42-75.33 181.7-75.32 75.3-181.8 75.3-106.46 0-181.8-75.3-75.33-75.28-75.33-181.7 0-106.4 75.33-181.7 75.33-75.3 181.8-75.3 106.47 0 181.8 75.3 75.34 75.3 75.34 181.7zM128.57 1552.5h1542.86V1424H128.57v128.5zM1285.7 976.26q0-159.62-113-272.56T900 590.76q-159.7 0-272.7 112.94t-113 272.56q0 159.62 113 272.56T900 1361.76q159.7 0 272.7-112.94t113-272.56zM257.15 331.76h385.72v-128.5H257.14v128.5zM128.57 524.5h1542.86v-257h-831.7L775.45 396H128.57v128.5zM1800 267.5v1285q0 53.2-37.67 90.85-37.66 37.65-90.9 37.65H128.57q-53.24 0-90.9-37.65Q0 1605.7 0 1552.5v-1285q0-53.2 37.67-90.85Q75.33 139 128.57 139h1542.86q53.24 0 90.9 37.65Q1800 214.3 1800 267.5z" fill="#fff"/></svg>
			OpenGallery<span id="albumname"> <?php echo $album; ?></span>
		</a>
	</div>
	<div id="navtoggle" class="navtoggle"><a href="javascript:document.getElementById('navigation').classList.toggle('open');">&#9776;</a></div>
	<div id="sitenavigation" class="navigation">
		<ul>
			<li><a href="index.php?a=<?php echo $album; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="453.33" height="379" viewBox="0 0 453.333 379"><g fill="#fff"><path d="M226.35 78.95L70.6 214.28c0 .2-.04.48-.13.86-.1.38-.13.65-.13.85v137c0 4.94 1.7 9.23 5.14 12.84 3.43 3.6 7.5 5.43 12.2 5.43h104v-109.6h69.34v109.65h104c4.7 0 8.77-1.82 12.2-5.44 3.43-3.6 5.15-7.9 5.15-12.87V216c0-.77-.1-1.34-.27-1.72L226.35 78.95z"></path><path d="M441.68 183.45l-59.32-51.96V15c0-2.66-.8-4.85-2.44-6.57-1.6-1.7-3.7-2.56-6.22-2.56h-52c-2.54 0-4.6.85-6.24 2.56-1.62 1.72-2.44 3.9-2.44 6.57v55.67l-66.08-58.24C241.16 7.48 234.3 5 226.36 5c-7.95 0-14.8 2.48-20.6 7.43L11.03 183.45c-1.8 1.52-2.8 3.56-2.98 6.14-.2 2.52.44 4.8 1.9 6.7l16.78 21.1c1.45 1.7 3.34 2.76 5.7 3.14 2.16.2 4.33-.48 6.5-2l187.42-164.7L413.8 218.56c1.43 1.33 3.33 2 5.67 2h.82c2.3-.4 4.2-1.44 5.65-3.15l16.8-21.12c1.43-1.9 2.07-4.15 1.88-6.72-.2-2.56-1.18-4.6-2.98-6.13z"></path></g></svg>
				Home</a></li>
			<li><a href="upload.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
				Upload</a></li>
			<li><a href="download.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"/><path d="M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z"/></g></svg>
				Download</a></li>
		</ul>
	</div>
</nav>