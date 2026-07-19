import { Facebook, Twitter, Linkedin, Mail, Phone, MapPin } from "lucide-react";
import { Link } from "react-router";
import asogLogo from "../imports/ASOG-TBI-stacked-v2.png";

export function Footer() {
  return (
    <footer className="site-footer bg-[#03558C] text-white/70 pt-12 w-full">
      <div className="max-w-[1320px] mx-auto px-4">
        {/* Main Grid */}
        <div className="ft-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-white/10">
          {/* Brand Column */}
          <div className="ft-col">
            <img
              src={asogLogo}
              alt="ASOG TBI Logo"
              className="ft-logo h-14 max-w-[220px] object-contain mb-4 opacity-90"
            />
            <p className="ft-tagline text-xs font-light leading-relaxed text-white/40 mb-6 max-w-[300px]">
              Advancing research, innovation, and technological development through
              institutional collaboration and knowledge sharing.
            </p>
            <div className="ft-social flex gap-2">
              <a
                href="#"
                className="ft-social-link flex items-center justify-center w-10 h-10 rounded-lg border border-white/10 text-white/35 hover:text-[#F8AF21] hover:border-[#F8AF21]/40 hover:bg-[#F8AF21]/10 transition-all"
                aria-label="Facebook"
              >
                <Facebook className="w-4 h-4" />
              </a>
              <a
                href="#"
                className="ft-social-link flex items-center justify-center w-10 h-10 rounded-lg border border-white/10 text-white/35 hover:text-[#F8AF21] hover:border-[#F8AF21]/40 hover:bg-[#F8AF21]/10 transition-all"
                aria-label="Twitter"
              >
                <Twitter className="w-4 h-4" />
              </a>
              <a
                href="#"
                className="ft-social-link flex items-center justify-center w-10 h-10 rounded-lg border border-white/10 text-white/35 hover:text-[#F8AF21] hover:border-[#F8AF21]/40 hover:bg-[#F8AF21]/10 transition-all"
                aria-label="LinkedIn"
              >
                <Linkedin className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div className="ft-col">
            <h3 className="ft-heading text-[0.6rem] font-bold tracking-[0.22em] uppercase text-[#F8AF21] mb-5 pb-2 relative">
              Quick Links
              <span className="absolute bottom-0 left-0 w-6 h-0.5 bg-[#F8AF21]/35 rounded"></span>
            </h3>
            <ul className="ft-links list-none m-0 p-0">
              <li className="mb-2.5">
                <Link
                  to="/"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Home
                </Link>
              </li>
              <li className="mb-2.5">
                <Link
                  to="/browse"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Browse Repository
                </Link>
              </li>
              <li className="mb-2.5">
                <Link
                  to="/upload"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Submit Research
                </Link>
              </li>
              <li className="mb-2.5">
                <Link
                  to="/about"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  About Us
                </Link>
              </li>
            </ul>
          </div>

          {/* Resources */}
          <div className="ft-col">
            <h3 className="ft-heading text-[0.6rem] font-bold tracking-[0.22em] uppercase text-[#F8AF21] mb-5 pb-2 relative">
              Resources
              <span className="absolute bottom-0 left-0 w-6 h-0.5 bg-[#F8AF21]/35 rounded"></span>
            </h3>
            <ul className="ft-links list-none m-0 p-0">
              <li className="mb-2.5">
                <a
                  href="#"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Guidelines
                </a>
              </li>
              <li className="mb-2.5">
                <a
                  href="#"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  FAQs
                </a>
              </li>
              <li className="mb-2.5">
                <a
                  href="#"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Policies
                </a>
              </li>
              <li className="mb-2.5">
                <a
                  href="#"
                  className="text-sm text-white/50 hover:text-[#F8AF21] transition-all hover:pl-1.5 relative"
                >
                  Support
                </a>
              </li>
            </ul>
          </div>

          {/* Contact */}
          <div className="ft-col">
            <h3 className="ft-heading text-[0.6rem] font-bold tracking-[0.22em] uppercase text-[#F8AF21] mb-5 pb-2 relative">
              Contact Us
              <span className="absolute bottom-0 left-0 w-6 h-0.5 bg-[#F8AF21]/35 rounded"></span>
            </h3>
            <ul className="ft-contact-list list-none m-0 p-0">
              <li className="flex items-start gap-2.5 mb-3.5 text-sm font-light leading-relaxed text-white/50">
                <MapPin className="ft-contact-icon w-4 h-4 flex-shrink-0 mt-0.5 text-[#F8AF21]/50" />
                <span>Camarines Sur Polytechnic Colleges, Nabua, Camarines Sur</span>
              </li>
              <li className="flex items-start gap-2.5 mb-3.5 text-sm font-light leading-relaxed text-white/50">
                <Mail className="ft-contact-icon w-4 h-4 flex-shrink-0 mt-0.5 text-[#F8AF21]/50" />
                <a href="mailto:repository@cspc.edu.ph" className="hover:text-[#F8AF21] transition-colors">
                  repository@cspc.edu.ph
                </a>
              </li>
              <li className="flex items-start gap-2.5 mb-3.5 text-sm font-light leading-relaxed text-white/50">
                <Phone className="ft-contact-icon w-4 h-4 flex-shrink-0 mt-0.5 text-[#F8AF21]/50" />
                <a href="tel:+639123456789" className="hover:text-[#F8AF21] transition-colors">
                  +63 912 345 6789
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="ft-bottom flex flex-col sm:flex-row gap-2 items-center justify-between py-6">
          <p className="ft-copyright text-[0.54rem] font-medium tracking-[0.09em] uppercase text-white/25 hover:text-white/35 transition-colors">
            © 2026 CSPC Institutional Repository. All Rights Reserved.
          </p>
          <p className="ft-funded text-[0.5rem] font-semibold tracking-[0.15em] uppercase text-[#F8AF21]/35 hover:text-[#F8AF21]/85 transition-colors">
            Funded by DOST-PCIEERD
          </p>
        </div>
      </div>
    </footer>
  );
}
