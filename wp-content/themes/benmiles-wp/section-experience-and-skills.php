<?php 
/*
Template Name: Section - Experience & Skills
*/

$jobs = [
	[
		'title' => 'Art Director & Web Developer',
		'company' => 'iTherapy',
		'link' => 'https://itherapy.com/',
		'dates'	=> 'March 2019 - Present',
		'location' => 'Remote',
		'description' => 'iTherapy is a one-stop SaaS for mental health professionals. When I started at Shire Digital, iTherapy was our biggest client, and the two companies joined together shortly after. All of my duties at Shire carried over to iTherapy, and I was also given the opportunity to lead a complete overhaul of iTherapy\'s branding, plus the creation of new sub-brands iThrive and myPractice.'
	],
	[
		'title' => 'Art Director & Web Developer',
		'company' => 'Shire Digital Solutions',
		'link' => 'https://shire-digital.com/',
		'dates'	=> 'May 2018 - Present',
		'location' => 'Remote',
		'description' => 'At Shire Digital, I assisted therapists in establishing an online presence through brand creation or optimization, bespoke website development, and pay-per-click ad campaign management. I performed both front-end and back-end development tasks solo or collaboratively on larger projects. As art director, I managed graphics and design needs for all projects. My experience gave me a unique perspective on tech and mental healthcare\'s intersection and the impact of digital tools on people\'s lives.'
	],
	[
		'title' => 'Web Developer, Graphic Designer',
		'company' => 'furryLogic',
		'link' => 'https://furrylogic.net/',
		'dates'	=> 'Nov. 2015 - May 2018',
		'location' => 'Cocoa Village, FL',
		'description' => 'furryLogic is a small start-up web development agency. I worked closely with both co-owners to create websites and graphics for a variety of clients. I was also responsible for the upkeep and maintenance of the company\'s website, as well as the creation of all marketing materials.'
	],
	[
		'title' => 'Graphic Designer, Pre-Press Specialist',
		'company' => 'PIP Printing & Marketing',
		'link' => 'https://pipbrevard.com/',
		'dates'	=> 'Feb. 2012 - Nov. 2015',
		'location' => 'Merritt Island, FL',
		'description' => 'PIP Printing & Marketing is a full-service print shop. I was responsible for the creation of all marketing materials, including brochures, flyers, business cards, and more. I also worked closely with the owner to create custom graphics for a variety of clients. I was also responsible for the upkeep and maintenance of the company\'s website, as well as the creation of all marketing materials.'
	],
	[
		'title' => 'Owner, Graphic Designer, Web Developer',
		'company' => 'BCGM3 Studios',
		'link' => 'https://bcgm3.com/',
		'dates'	=> 'March 2009 - Sept. 2012',
		'location' => 'Merritt Island, FL',
		'description' => 'I incorporated as BCGM3 Studios, LLC after graduating from UCF, and operated out of a store in the Merritt Square Mall, back in my home town of Merritt Island. Most of my work was in print design, but I also created numerous websites, and even did some large-format signage installation. I got to work with a huge variety of local businesses, and slowly but surely, I made a name for myself.'
	]
];

$schools = [
	[
		'title' => 'Bachelors of Fine Arts in Graphic Design',
		'company' => 'University of Central Florida',
		'link' => 'http://svad.cah.ucf.edu/',
		'dates'	=> '2006 - 2009',
		'location' => 'Orlando, FL'
	],
	[
		'title' => 'Associates of Arts with a Concentration in Design',
		'company' => 'Eastern Florida State College',
		'link' => 'http://easternflorida.edu/',
		'dates'	=> '2004 - 2006',
		'location' => 'Cocoa, FL'
	]
];
?>

<!-- experience-and-skills -->
<section id="experience-and-skills">

    <!-- content -->
    <div class="section-body">
        <div class="container">
            <div class="row">

				<!-- experience -->
				<div class="column column-9 experience">
					<h2 class="heading animated" data-animation="fadeIn">Experience</h2>
                    <ul class="timeline animated" data-animation="fadeIn" style="animation-delay:0.1s;">

						<?php
							foreach($jobs as $job) {
								echo '<li class="timeline-item animated" data-animation="fadeInUp">
										<div class="timeline-badge">
											' . displaySVG('work') . '
										</div>
										<div class="timeline-panel">
											<h4 class="timeline-title">' . $job['title'] . '</h4>
											<ul class="timeline-details">
												<li>' . displaySVG('external-link') . '<a href="' . $job['link'] . '" target="_blank">' . $job['company'] . '</a></li>
												<li>' . displaySVG('calendar') . $job['dates'] . '</li>
												<li>' . displaySVG('map-pin') . $job['location'] . '</li>
											</ul>
											<p>' . $job['description'] . '</p>
										</div>
									</li>';
							}
						?>

					</ul>
					<h2 class="heading animated" data-animation="fadeIn">Education</h2>
                    <ul class="timeline animated" data-animation="fadeIn" style="animation-delay:0.1s;">

					<?php
						foreach($schools as $school) {
							echo '<li class="timeline-item animated" data-animation="fadeInUp">
									<div class="timeline-badge">
										' . displaySVG('school') . '
									</div>
									<div class="timeline-panel">
										<h4 class="timeline-title">' . $school['title'] . '</h4>
										<ul class="timeline-details">
											<li>' . displaySVG('external-link') . '<a href="' . $school['link'] . '" target="_blank">' . $school['company'] . '</a></li>
											<li>' . displaySVG('calendar') . $school['dates'] . '</li>
											<li>' . displaySVG('map-pin') . $school['location'] . '</li>
										</ul>
									</div>
								</li>';
						}
					?>

                    </ul>
                </div>
				<!-- / experience -->

				<!-- skills -->
                <div class="column column-3 skills" style="justify-content: flex-start;">
					<h2 class="heading animated" data-animation="fadeIn">Skills</h2>

					<!-- code languages -->
					<h3 class="sub-heading animated" data-animation="fadeInUp">Code Languages</h3>
					<div class="row">
						<?php 
							$icons = ['html', 'css', 'js', 'php', 'mysql'];
							$animationDelay = 0;
							foreach ($icons as $icon) {
								echo '<div class="skill-icon animated" data-animation="fadeInUp" style="animation-delay: ' . $animationDelay . 's;">' . displaySVG($icon) . '</div>';
								$animationDelay += 0.1;
							}
						?>
					</div>

					<!-- frameworks, libraries -->
					<h3 class="sub-heading animated" data-animation="fadeInUp">Frameworks & Libraries</h3>
					<div class="row">
						<?php
							$icons = ['bootstrap', 'jquery', 'joomla', 'vue', 'laravel', 'wordpress'];
							$animationDelay = 0;
							foreach ($icons as $icon) {
								echo '<div class="skill-icon wide animated" data-animation="fadeInUp" style="animation-delay: ' . $animationDelay . 's;">' . displaySVG($icon) . '</div>';
								$animationDelay += 0.1;
							}
						?>
					</div>

					<!-- software -->
					<h3 class="sub-heading animated" data-animation="fadeInUp">Software</h3>
					<div class="row">
						<?php
							$icons = ['illustrator', 'indesign', 'photoshop', 'phpstorm', 'vscode'];
							$animationDelay = 0;
							foreach ($icons as $icon) {
								echo '<div class="skill-icon animated" data-animation="fadeInUp" style="animation-delay: ' . $animationDelay . 's;">' . displaySVG($icon) . '</div>';
								$animationDelay += 0.1;
							}
						// TODO: Add Figma icon
						// TODO: Update Adobe icons
						?>
					</div>
					
				</div>
				<!-- / skills -->

			</div>				
        </div>
    </div>
    <!-- / content -->

</section>
<!-- / timeline -->