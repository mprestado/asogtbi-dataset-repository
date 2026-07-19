import { Target, Users, Award, Lightbulb } from "lucide-react";

export function About() {
  return (
    <div className="min-h-screen bg-[#F8F6F2]">
      {/* Header */}
      <section className="bg-gradient-to-br from-[#03558C] to-[#02447A] text-white py-12">
        <div className="max-w-[1200px] mx-auto px-4">
          <h1 className="text-3xl lg:text-4xl font-bold mb-4">About Us</h1>
          <p className="text-lg text-white/80">
            Learn more about our mission, vision, and the people behind the repository.
          </p>
        </div>
      </section>

      {/* Mission & Vision */}
      <section className="py-16 bg-white">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10">
              <div className="w-14 h-14 bg-[#03558C] rounded-lg flex items-center justify-center mb-5">
                <Target className="w-7 h-7 text-white" />
              </div>
              <h2 className="text-2xl font-bold text-[#03558C] mb-4">Our Mission</h2>
              <p className="text-[#03558C]/70 leading-relaxed">
                To provide a comprehensive, accessible, and sustainable platform for preserving,
                disseminating, and promoting scholarly research and academic excellence. We aim to
                foster innovation, collaboration, and knowledge sharing among researchers,
                students, and institutions in the Bicol region and beyond.
              </p>
            </div>

            <div className="bg-[#F8F6F2] rounded-xl p-8 border-2 border-[#03558C]/10">
              <div className="w-14 h-14 bg-[#F8AF21] rounded-lg flex items-center justify-center mb-5">
                <Lightbulb className="w-7 h-7 text-white" />
              </div>
              <h2 className="text-2xl font-bold text-[#03558C] mb-4">Our Vision</h2>
              <p className="text-[#03558C]/70 leading-relaxed">
                To be the leading institutional repository in the Philippines, recognized for our
                commitment to open access scholarship, research innovation, and the advancement of
                knowledge that addresses local and global challenges through evidence-based
                solutions and collaborative research.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* About Content */}
      <section className="py-16">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="max-w-[800px] mx-auto">
            <h2 className="text-3xl font-bold text-[#03558C] mb-6">
              About the Repository
            </h2>
            <div className="space-y-4 text-[#03558C]/70 leading-relaxed">
              <p>
                The CSPC Institutional Repository is a digital archive that collects, preserves, and
                provides access to the intellectual output of Camarines Sur Polytechnic Colleges and
                its partner institutions. Established in 2024, the repository serves as a central hub
                for research papers, theses, dissertations, conference proceedings, and other
                scholarly materials.
              </p>
              <p>
                Our repository is built on the principles of open access, ensuring that research
                outputs are freely available to students, faculty, researchers, and the broader
                community. We believe that knowledge should be accessible to all, promoting
                transparency, innovation, and collaborative research.
              </p>
              <p>
                Supported by the Department of Science and Technology - Philippine Council for
                Industry, Energy and Emerging Technology Research and Development (DOST-PCIEERD), we
                are committed to advancing research capacity and promoting evidence-based solutions to
                regional and national challenges.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Core Values */}
      <section className="py-16 bg-white">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-[#03558C] mb-4">Our Core Values</h2>
            <p className="text-lg text-[#03558C]/70 max-w-[640px] mx-auto">
              The principles that guide our work and commitment to academic excellence.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Award className="w-8 h-8 text-[#03558C]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-2">Excellence</h3>
              <p className="text-sm text-[#03558C]/70">
                Committed to the highest standards of academic quality and integrity.
              </p>
            </div>

            <div className="text-center p-6">
              <div className="w-16 h-16 bg-[#F8AF21]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Users className="w-8 h-8 text-[#F8AF21]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-2">Collaboration</h3>
              <p className="text-sm text-[#03558C]/70">
                Fostering partnerships and knowledge sharing across institutions.
              </p>
            </div>

            <div className="text-center p-6">
              <div className="w-16 h-16 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Lightbulb className="w-8 h-8 text-[#03558C]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-2">Innovation</h3>
              <p className="text-sm text-[#03558C]/70">
                Embracing new ideas and technologies to advance research.
              </p>
            </div>

            <div className="text-center p-6">
              <div className="w-16 h-16 bg-[#F8AF21]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Target className="w-8 h-8 text-[#F8AF21]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-2">Accessibility</h3>
              <p className="text-sm text-[#03558C]/70">
                Ensuring open access to knowledge for all members of society.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Team */}
      <section className="py-16">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold text-[#03558C] mb-4">Our Team</h2>
            <p className="text-lg text-[#03558C]/70 max-w-[640px] mx-auto">
              Dedicated professionals working to advance research and innovation.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div className="bg-white rounded-xl p-6 border-2 border-[#03558C]/10 text-center hover:shadow-lg transition-all">
              <div className="w-24 h-24 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Users className="w-12 h-12 text-[#03558C]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-1">Dr. Maria Santos</h3>
              <p className="text-sm text-[#F8AF21] mb-3">Repository Director</p>
              <p className="text-sm text-[#03558C]/70">
                Leading the strategic direction and development of the institutional repository.
              </p>
            </div>

            <div className="bg-white rounded-xl p-6 border-2 border-[#03558C]/10 text-center hover:shadow-lg transition-all">
              <div className="w-24 h-24 bg-[#F8AF21]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Users className="w-12 h-12 text-[#F8AF21]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-1">Prof. Juan Dela Cruz</h3>
              <p className="text-sm text-[#F8AF21] mb-3">Research Coordinator</p>
              <p className="text-sm text-[#03558C]/70">
                Managing research submissions and ensuring quality standards.
              </p>
            </div>

            <div className="bg-white rounded-xl p-6 border-2 border-[#03558C]/10 text-center hover:shadow-lg transition-all">
              <div className="w-24 h-24 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Users className="w-12 h-12 text-[#03558C]" />
              </div>
              <h3 className="font-bold text-[#03558C] mb-1">Ms. Ana Reyes</h3>
              <p className="text-sm text-[#F8AF21] mb-3">Digital Archivist</p>
              <p className="text-sm text-[#03558C]/70">
                Preserving and organizing digital collections for long-term access.
              </p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
