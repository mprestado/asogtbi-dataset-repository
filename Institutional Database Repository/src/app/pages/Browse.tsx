import { useState } from "react";
import { Search, Filter, Download, Eye, Calendar, User } from "lucide-react";
import { Input } from "../components/ui/input";
import { Button } from "../components/ui/button";
import { Badge } from "../components/ui/badge";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "../components/ui/select";

const mockResearch = [
  {
    id: 1,
    title: "Machine Learning Applications in Agricultural Productivity",
    author: "Dr. Maria Santos",
    date: "2025-12-15",
    department: "Computer Science",
    type: "Research Paper",
    abstract:
      "This study explores the implementation of machine learning algorithms to predict crop yields and optimize farming practices in the Bicol region.",
    downloads: 245,
    views: 1230,
  },
  {
    id: 2,
    title: "Sustainable Energy Solutions for Rural Communities",
    author: "Eng. Juan dela Cruz",
    date: "2025-11-20",
    department: "Engineering",
    type: "Thesis",
    abstract:
      "An investigation into renewable energy technologies suitable for implementation in off-grid rural communities in Camarines Sur.",
    downloads: 189,
    views: 876,
  },
  {
    id: 3,
    title: "Impact of Digital Literacy Programs on Community Development",
    author: "Prof. Ana Reyes",
    date: "2025-10-08",
    department: "Education",
    type: "Research Paper",
    abstract:
      "A comprehensive analysis of digital literacy initiatives and their effects on socio-economic development in local communities.",
    downloads: 312,
    views: 1450,
  },
  {
    id: 4,
    title: "Climate Change Adaptation Strategies in Coastal Areas",
    author: "Dr. Roberto Garcia",
    date: "2025-09-12",
    department: "Environmental Science",
    type: "Dissertation",
    abstract:
      "This dissertation examines climate resilience strategies for coastal communities facing rising sea levels and extreme weather events.",
    downloads: 421,
    views: 2100,
  },
  {
    id: 5,
    title: "Blockchain Technology in Supply Chain Management",
    author: "Ms. Catherine Lim",
    date: "2025-08-25",
    department: "Business Administration",
    type: "Research Paper",
    abstract:
      "Exploring the potential of blockchain technology to enhance transparency and efficiency in agricultural supply chains.",
    downloads: 298,
    views: 1567,
  },
  {
    id: 6,
    title: "Indigenous Knowledge Systems in Modern Healthcare",
    author: "Dr. Pedro Villanueva",
    date: "2025-07-30",
    department: "Health Sciences",
    type: "Research Paper",
    abstract:
      "An exploration of traditional healing practices and their integration with contemporary medical approaches in rural healthcare.",
    downloads: 167,
    views: 934,
  },
];

export function Browse() {
  const [searchQuery, setSearchQuery] = useState("");
  const [selectedDepartment, setSelectedDepartment] = useState("all");
  const [selectedType, setSelectedType] = useState("all");

  const filteredResearch = mockResearch.filter((item) => {
    const matchesSearch =
      item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
      item.author.toLowerCase().includes(searchQuery.toLowerCase()) ||
      item.abstract.toLowerCase().includes(searchQuery.toLowerCase());
    const matchesDepartment =
      selectedDepartment === "all" || item.department === selectedDepartment;
    const matchesType = selectedType === "all" || item.type === selectedType;

    return matchesSearch && matchesDepartment && matchesType;
  });

  return (
    <div className="min-h-screen bg-[#F8F6F2]">
      {/* Header */}
      <section className="bg-gradient-to-br from-[#03558C] to-[#02447A] text-white py-12">
        <div className="max-w-[1200px] mx-auto px-4">
          <h1 className="text-3xl lg:text-4xl font-bold mb-4">Browse Repository</h1>
          <p className="text-lg text-white/80">
            Explore our collection of research papers, theses, and academic publications.
          </p>
        </div>
      </section>

      {/* Search & Filters */}
      <section className="bg-white border-b border-[#03558C]/10 sticky top-[78px] z-50 shadow-sm">
        <div className="max-w-[1200px] mx-auto px-4 py-6">
          <div className="flex flex-col lg:flex-row gap-4">
            <div className="relative flex-1">
              <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#03558C]/50" />
              <Input
                type="text"
                placeholder="Search by title, author, or keywords..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="pl-11 h-11 border-[#03558C]/20 focus:border-[#F8AF21]"
              />
            </div>

            <div className="flex flex-col sm:flex-row gap-3">
              <Select value={selectedDepartment} onValueChange={setSelectedDepartment}>
                <SelectTrigger className="w-full sm:w-[200px] h-11 border-[#03558C]/20">
                  <SelectValue placeholder="Department" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="all">All Departments</SelectItem>
                  <SelectItem value="Computer Science">Computer Science</SelectItem>
                  <SelectItem value="Engineering">Engineering</SelectItem>
                  <SelectItem value="Education">Education</SelectItem>
                  <SelectItem value="Environmental Science">Environmental Science</SelectItem>
                  <SelectItem value="Business Administration">Business Administration</SelectItem>
                  <SelectItem value="Health Sciences">Health Sciences</SelectItem>
                </SelectContent>
              </Select>

              <Select value={selectedType} onValueChange={setSelectedType}>
                <SelectTrigger className="w-full sm:w-[200px] h-11 border-[#03558C]/20">
                  <SelectValue placeholder="Type" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="all">All Types</SelectItem>
                  <SelectItem value="Research Paper">Research Paper</SelectItem>
                  <SelectItem value="Thesis">Thesis</SelectItem>
                  <SelectItem value="Dissertation">Dissertation</SelectItem>
                  <SelectItem value="Project">Project</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>

          <div className="mt-4 flex items-center justify-between">
            <p className="text-sm text-[#03558C]/70">
              Showing <span className="font-semibold">{filteredResearch.length}</span> results
            </p>
            <Button variant="outline" size="sm" className="border-[#03558C]/20">
              <Filter className="w-4 h-4 mr-2" />
              More Filters
            </Button>
          </div>
        </div>
      </section>

      {/* Results */}
      <section className="py-10">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="space-y-6">
            {filteredResearch.map((item) => (
              <div
                key={item.id}
                className="bg-white rounded-xl p-6 border-2 border-[#03558C]/10 hover:border-[#F8AF21]/40 transition-all hover:shadow-lg"
              >
                <div className="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                  <div className="flex-1">
                    <div className="flex flex-wrap items-center gap-2 mb-3">
                      <Badge className="bg-[#03558C] text-white">{item.type}</Badge>
                      <Badge variant="outline" className="border-[#F8AF21] text-[#03558C]">
                        {item.department}
                      </Badge>
                    </div>

                    <h3 className="text-xl font-bold text-[#03558C] mb-2 hover:text-[#F8AF21] transition-colors cursor-pointer">
                      {item.title}
                    </h3>

                    <div className="flex flex-wrap items-center gap-4 text-sm text-[#03558C]/60 mb-3">
                      <div className="flex items-center gap-1.5">
                        <User className="w-4 h-4" />
                        <span>{item.author}</span>
                      </div>
                      <div className="flex items-center gap-1.5">
                        <Calendar className="w-4 h-4" />
                        <span>{new Date(item.date).toLocaleDateString()}</span>
                      </div>
                    </div>

                    <p className="text-[#03558C]/70 leading-relaxed mb-4">
                      {item.abstract}
                    </p>

                    <div className="flex items-center gap-6 text-sm text-[#03558C]/50">
                      <div className="flex items-center gap-1.5">
                        <Eye className="w-4 h-4" />
                        <span>{item.views} views</span>
                      </div>
                      <div className="flex items-center gap-1.5">
                        <Download className="w-4 h-4" />
                        <span>{item.downloads} downloads</span>
                      </div>
                    </div>
                  </div>

                  <div className="flex lg:flex-col gap-2">
                    <Button className="bg-[#03558C] hover:bg-[#02447A] text-white">
                      <Eye className="w-4 h-4 mr-2" />
                      View
                    </Button>
                    <Button variant="outline" className="border-[#03558C]/20">
                      <Download className="w-4 h-4 mr-2" />
                      Download
                    </Button>
                  </div>
                </div>
              </div>
            ))}
          </div>

          {filteredResearch.length === 0 && (
            <div className="text-center py-20">
              <div className="w-20 h-20 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <Search className="w-10 h-10 text-[#03558C]/30" />
              </div>
              <h3 className="text-2xl font-bold text-[#03558C] mb-2">No results found</h3>
              <p className="text-[#03558C]/70">
                Try adjusting your search or filters to find what you're looking for.
              </p>
            </div>
          )}
        </div>
      </section>
    </div>
  );
}
