import { useState, useEffect } from "react";
import { Link, useLocation } from "react-router";
import { Menu, X, ChevronDown } from "lucide-react";
import cspcLogo from "../imports/cspc.png";

export function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [programsOpen, setProgramsOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 60);
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    setMenuOpen(false);
    setProgramsOpen(false);
  }, [location]);

  return (
    <header
      id="navbar"
      className={`fixed top-0 left-0 right-0 z-[9999] transition-all duration-300 ${
        scrolled ? "bg-[#03558C] shadow-lg" : "bg-[#03558C]/95 backdrop-blur-sm"
      }`}
    >
      <div className="max-w-[1320px] mx-auto px-4">
        <div className="flex items-center justify-between h-[78px]">
          {/* Logo */}
          <Link to="/" className="flex items-center gap-3" id="navLogo">
            <img
              src={cspcLogo}
              alt="CSPC Logo"
              className="h-14 w-auto object-contain"
            />
            <div className="hidden lg:block">
              <div className="text-white font-semibold text-sm tracking-wide">
                CSPC Institutional Repository
              </div>
              <div className="text-[#F8AF21] text-xs font-medium">
                Research & Innovation Database
              </div>
            </div>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden lg:flex items-center gap-8">
            <Link
              to="/"
              className={`text-white/90 hover:text-[#F8AF21] transition-colors text-sm font-medium ${
                location.pathname === "/" ? "text-[#F8AF21]" : ""
              }`}
            >
              Home
            </Link>
            <Link
              to="/browse"
              className={`text-white/90 hover:text-[#F8AF21] transition-colors text-sm font-medium ${
                location.pathname === "/browse" ? "text-[#F8AF21]" : ""
              }`}
            >
              Browse Repository
            </Link>
            <Link
              to="/upload"
              className={`text-white/90 hover:text-[#F8AF21] transition-colors text-sm font-medium ${
                location.pathname === "/upload" ? "text-[#F8AF21]" : ""
              }`}
            >
              Upload
            </Link>
            <Link
              to="/about"
              className={`text-white/90 hover:text-[#F8AF21] transition-colors text-sm font-medium ${
                location.pathname === "/about" ? "text-[#F8AF21]" : ""
              }`}
            >
              About
            </Link>
            <Link
              to="/contact"
              className={`text-white/90 hover:text-[#F8AF21] transition-colors text-sm font-medium ${
                location.pathname === "/contact" ? "text-[#F8AF21]" : ""
              }`}
            >
              Contact
            </Link>
          </nav>

          {/* Mobile Menu Button */}
          <button
            id="menuBtn"
            className="lg:hidden text-white p-2"
            onClick={() => setMenuOpen(!menuOpen)}
            aria-label="Toggle menu"
          >
            {menuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>

        {/* Mobile Menu */}
        {menuOpen && (
          <div
            id="mobileMenu"
            className="lg:hidden pb-6 border-t border-white/10"
          >
            <nav className="flex flex-col gap-2 pt-4">
              <Link
                to="/"
                className={`text-white/90 hover:text-[#F8AF21] transition-colors py-3 px-4 rounded ${
                  location.pathname === "/" ? "bg-white/10 text-[#F8AF21]" : ""
                }`}
              >
                Home
              </Link>
              <Link
                to="/browse"
                className={`text-white/90 hover:text-[#F8AF21] transition-colors py-3 px-4 rounded ${
                  location.pathname === "/browse" ? "bg-white/10 text-[#F8AF21]" : ""
                }`}
              >
                Browse Repository
              </Link>
              <Link
                to="/upload"
                className={`text-white/90 hover:text-[#F8AF21] transition-colors py-3 px-4 rounded ${
                  location.pathname === "/upload" ? "bg-white/10 text-[#F8AF21]" : ""
                }`}
              >
                Upload
              </Link>
              <Link
                to="/about"
                className={`text-white/90 hover:text-[#F8AF21] transition-colors py-3 px-4 rounded ${
                  location.pathname === "/about" ? "bg-white/10 text-[#F8AF21]" : ""
                }`}
              >
                About
              </Link>
              <Link
                to="/contact"
                className={`text-white/90 hover:text-[#F8AF21] transition-colors py-3 px-4 rounded ${
                  location.pathname === "/contact" ? "bg-white/10 text-[#F8AF21]" : ""
                }`}
              >
                Contact
              </Link>
            </nav>
          </div>
        )}
      </div>
    </header>
  );
}
