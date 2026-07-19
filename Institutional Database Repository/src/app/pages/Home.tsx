import { Search, Upload, Database, BookOpen, Award, Users } from "lucide-react";
import { Link } from "react-router";
import { Button } from "../components/ui/button";
import { Input } from "../components/ui/input";
import dostLogo from "../imports/dost-region5.png";
import pcieerd from "../imports/pcieerd.png";
import cspcLogo from "../imports/Proposed-Logo-College-of-Computer-Studies-CSPC-03-150x150.png";

export function Home() {
  return (
    <div className="bg-[#F8F6F2]">
      {/* Hero Section */}
      <section className="bg-gradient-to-br from-[#03558C] to-[#02447A] text-white py-20 lg:py-32">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="max-w-[800px] mx-auto text-center">
            <h1 className="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
              Institutional Database Repository
            </h1>
            <p className="text-lg lg:text-xl text-white/80 mb-10 leading-relaxed">
              Discover, access, and share cutting-edge research and innovation from
              CSPC and partner institutions. Your gateway to academic excellence.
            </p>

            {/* Search Bar */}
            <div className="flex flex-col sm:flex-row gap-3 max-w-[640px] mx-auto mb-8">
              <div className="relative flex-1">
                <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#03558C]/50" />
                <Input
                  type="text"
                  placeholder="Search research papers, theses, projects..."
                  className="pl-11 h-12 bg-white border-none shadow-lg"
                />
              </div>
              <Button className="h-12 px-8 bg-[#F8AF21] hover:bg-[#e8a900] text-[#03558C] font-semibold shadow-lg">
                Search
              </Button>
            </div>

            <div className="flex flex-wrap justify-center gap-4">
              <Link to="/browse">
                <Button variant="outline" className="bg-white/10 border-white/30 text-white hover:bg-white/20 hover:text-white">
                  Browse Repository
                </Button>
              </Link>
              <Link to="/upload">
                <Button variant="outline" className="bg-white/10 border-white/30 text-white hover:bg-white/20 hover:text-white">
                  <Upload className="w-4 h-4 mr-2" />
                  Submit Research
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 bg-white">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="text-center mb-16">
            <h2 className="text-3xl lg:text-4xl font-bold text-[#03558C] mb-4">
              Repository Features
            </h2>
            <p className="text-lg text-[#03558C]/70 max-w-[640px] mx-auto">
              Access a comprehensive collection of academic works, research outputs,
              and scholarly materials.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {/* Feature 1 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#03558C] rounded-lg flex items-center justify-center mb-5">
                <Database className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Extensive Database
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                Access thousands of research papers, theses, dissertations, and
                academic publications from various disciplines.
              </p>
            </div>

            {/* Feature 2 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#F8AF21] rounded-lg flex items-center justify-center mb-5">
                <Search className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Advanced Search
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                Find exactly what you need with powerful search filters by author,
                date, subject, department, and keywords.
              </p>
            </div>

            {/* Feature 3 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#03558C] rounded-lg flex items-center justify-center mb-5">
                <BookOpen className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Open Access
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                Free and unrestricted access to scholarly works, promoting knowledge
                sharing and academic collaboration.
              </p>
            </div>

            {/* Feature 4 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#F8AF21] rounded-lg flex items-center justify-center mb-5">
                <Award className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Quality Assured
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                All submissions undergo rigorous review processes to ensure academic
                integrity and research excellence.
              </p>
            </div>

            {/* Feature 5 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#03558C] rounded-lg flex items-center justify-center mb-5">
                <Users className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Collaborative Platform
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                Connect with researchers, access their work, and build on existing
                knowledge to advance your field.
              </p>
            </div>

            {/* Feature 6 */}
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg">
              <div className="w-14 h-14 bg-[#F8AF21] rounded-lg flex items-center justify-center mb-5">
                <Upload className="w-7 h-7 text-white" />
              </div>
              <h3 className="text-xl font-bold text-[#03558C] mb-3">
                Easy Submission
              </h3>
              <p className="text-[#03558C]/70 leading-relaxed">
                Submit your research with our streamlined upload process, complete
                with metadata management and version control.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-20 bg-gradient-to-br from-[#03558C] to-[#02447A] text-white">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div className="space-y-2">
              <div className="text-5xl font-bold text-[#F8AF21]">2,450+</div>
              <div className="text-white/80">Research Papers</div>
            </div>
            <div className="space-y-2">
              <div className="text-5xl font-bold text-[#F8AF21]">850+</div>
              <div className="text-white/80">Theses & Dissertations</div>
            </div>
            <div className="space-y-2">
              <div className="text-5xl font-bold text-[#F8AF21]">420+</div>
              <div className="text-white/80">Active Researchers</div>
            </div>
            <div className="space-y-2">
              <div className="text-5xl font-bold text-[#F8AF21]">15</div>
              <div className="text-white/80">Partner Institutions</div>
            </div>
          </div>
        </div>
      </section>

      {/* Partners Section */}
      <section className="py-20 bg-white">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="text-center mb-12">
            <h2 className="text-3xl lg:text-4xl font-bold text-[#03558C] mb-4">
              Our Partners
            </h2>
            <p className="text-lg text-[#03558C]/70 max-w-[640px] mx-auto">
              Collaborating with leading institutions to advance research and innovation.
            </p>
          </div>

          <div className="flex flex-wrap justify-center items-center gap-12 lg:gap-20">
            <div className="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
              <img
                src={dostLogo}
                alt="DOST Region 5"
                className="h-20 w-auto object-contain"
              />
            </div>
            <div className="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
              <img
                src={pcieerd}
                alt="PCIEERD"
                className="h-20 w-auto object-contain"
              />
            </div>
            <div className="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
              <img
                src={cspcLogo}
                alt="CSPC College of Computer Studies"
                className="h-20 w-auto object-contain"
              />
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 bg-[#F8F6F2]">
        <div className="max-w-[800px] mx-auto px-4 text-center">
          <h2 className="text-3xl lg:text-4xl font-bold text-[#03558C] mb-6">
            Ready to Explore?
          </h2>
          <p className="text-lg text-[#03558C]/70 mb-10 leading-relaxed">
            Start discovering innovative research and contribute to the academic
            community today.
          </p>
          <div className="flex flex-wrap justify-center gap-4">
            <Link to="/browse">
              <Button className="h-12 px-8 bg-[#03558C] hover:bg-[#02447A] text-white">
                Browse Repository
              </Button>
            </Link>
            <Link to="/upload">
              <Button className="h-12 px-8 bg-[#F8AF21] hover:bg-[#e8a900] text-[#03558C]">
                Submit Your Research
              </Button>
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}
