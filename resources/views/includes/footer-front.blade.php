 <!-- ======= Footer ======= -->
 <footer id="footer">



    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>MENU</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.accueil') }}">ACCUEIL</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.dashboard') }}">Donnees environnementales</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.faq') }}">Faq</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.blog') }}">Publications</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.contact') }}t">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>LIENS UTILES</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="https://www.arpce.cg/">ARPCE</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://postetelecom.gouv.cg/">Ministere des Postes et Telecoms</a></li>

            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contactez nous</h4>
            <p>
                91 bis Avenue de l'Amitié - Centre ville Brazzaville<br><br>
              <strong>Tel:</strong> +242 05 510 72 72<br>
              <strong>Email:</strong> contact@arpce.cg<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>A PROPOS DE L'Observatoire</h3>
            <p>Notre observatoire est une initiative ambitieuse lancée par l'Agence de Régulation des Postes et Communications Électroniques (ARPCE) dans le but de mieux comprendre les impacts environnementaux du développement du numérique au Congo et de promouvoir des solutions durables..</p>
            <div class="social-links mt-3">
              <a href="https://twitter.com/ARPCECongo" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="https://facebook.com/arpce" class="facebook"><i class="bx bxl-facebook"></i></a>

              <a href="https://linkedin.com/company/arpce-congo" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Observatoire du Numerique Responsable</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('Eterna/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('Eterna/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('Eterna/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('Eterna/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('Eterna/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('Eterna/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('Eterna/assets/js/main.js') }}"></script>
  @yield('modal')
</body>

</html>
