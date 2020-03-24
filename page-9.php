<?php get_header(); ?>
<main id="pageMain" role="main">
	<article>
		<section id="intro">
			<div class="table wrapper">
				<div class="tableCell">
					<div class="headingBox">
						<h1 class="heading">
							<small>Learn more about me</small><br><span class="name">and get in touch</span>
						</h1>
						<div class="headingMore">
							<p>A bit about my career and passion.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="contact">
			<div class="wrapper">
				<p>hello<span>@</span>matthiaskrueger.info</p>
			</div>
		</section>	
		<div class="content wrapper aboutMe">
			<article class="career">
				<h2>Career</h2>
				<section>
					<div class="flexItem textBox">
						<h3>University</h3>
						<p>I'm studying Computer Science &amp; Media at the Brandenburg University of Applied Sciences and had the opportunity to study abroad. At the University of California in Los Angeles I attended the curse Design &amp; Media Arts and at the University of the West of Scotland Business English.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 496, 'medium' ); ?>
						<figcaption>University of California Los Angeles, USA</figcaption>
					</figure>
				</section>
				<section>
					<div class="flexItem textBox">
						<h3>Freelancing</h3>
						<p>On the side of my study I freelance as an administrator for Apple based systems. I carry out usual IT work, product consulting and platform transitions.<br>With the background of gaining more practical experience with Use Experience and Interaction Design I'm lately active as an Website developer.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 494, 'medium' ); ?>
						<figcaption>Home Office, Potsdam Germany</figcaption>
					</figure>
				</section>
				<section>
					<div class="flexItem textBox">
						<h3>Working Student</h3>
						<p>For that awesome Job, I gladly took some more time for my study, because the status of a student was needed. My area of responsibility was to operate the Satellite Laser Ranging Station at the German Research Centre for Geosciences and perform highly precise range measurements to special satellites.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 492, 'medium' ); ?>
						<figcaption>Satellite Laser Range Measurement, Potsdam Germany</figcaption>
					</figure>
				</section>
			</article>
			<article class="passion">
				<h2>Passion</h2>
				<section>
					<div class="flexItem textBox">
						<h3>Climbing</h3>
						<p>Eight years age, my brother and I started with bouldering and later we climbed with rope. But free climbing over water has become our true passion. Unfortunately it is almost impossible to practice that sport where we live. Good thing that traveling belongs to my favorite ventures.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 495, 'medium' ); ?>
						<figcaption>Deep Water Solo, Krabi Thailand</figcaption>
					</figure>
				</section>
				<section>
					<div class="flexItem textBox">
						<h3>Photography</h3>
						<p>I enjoy my new camera equipment and a began to work more with Apple Final Cut Pro.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 1151, 'medium' ); ?>
						<figcaption>Sea Lion, New Zealand</figcaption>
					</figure>
				</section>
				<section>
					<div class="flexItem textBox">
						<h3>Longboarding</h3>
						<p>Over the first couple of years I constructed three Longboards for myself. Since I ride downhill with up to 60km/h I own that fantastic Root Honey Badger.</p>
					</div>
					<figure class="flexItem imageBox">
						<?php echo wp_get_attachment_link( 810, 'medium' ); ?>
						<figcaption>Downhill Longboard, Berlin Germany</figcaption>
					</figure>
				</section>
			</article>
		</div>
	</article>
</main>
<?php get_footer(); ?>