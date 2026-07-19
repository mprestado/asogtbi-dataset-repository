import { useState } from "react";
import { Upload as UploadIcon, FileText, CheckCircle, AlertCircle } from "lucide-react";
import { Button } from "../components/ui/button";
import { Input } from "../components/ui/input";
import { Label } from "../components/ui/label";
import { Textarea } from "../components/ui/textarea";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "../components/ui/select";

export function Upload() {
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setSubmitted(true);
    setTimeout(() => setSubmitted(false), 5000);
  };

  return (
    <div className="min-h-screen bg-[#F8F6F2]">
      {/* Header */}
      <section className="bg-gradient-to-br from-[#03558C] to-[#02447A] text-white py-12">
        <div className="max-w-[1200px] mx-auto px-4">
          <h1 className="text-3xl lg:text-4xl font-bold mb-4">Submit Your Research</h1>
          <p className="text-lg text-white/80">
            Share your academic work with the research community.
          </p>
        </div>
      </section>

      {/* Form Section */}
      <section className="py-12">
        <div className="max-w-[800px] mx-auto px-4">
          {submitted ? (
            <div className="bg-white rounded-xl p-8 border-2 border-green-500/20 text-center">
              <div className="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <CheckCircle className="w-8 h-8 text-green-600" />
              </div>
              <h2 className="text-2xl font-bold text-[#03558C] mb-3">
                Submission Successful!
              </h2>
              <p className="text-[#03558C]/70 mb-6">
                Your research has been submitted for review. You will receive a confirmation email shortly.
              </p>
              <Button
                onClick={() => setSubmitted(false)}
                className="bg-[#03558C] hover:bg-[#02447A] text-white"
              >
                Submit Another
              </Button>
            </div>
          ) : (
            <div className="bg-white rounded-xl p-8 border-2 border-[#03558C]/10 shadow-lg">
              <div className="mb-8">
                <h2 className="text-2xl font-bold text-[#03558C] mb-3">
                  Research Submission Form
                </h2>
                <p className="text-[#03558C]/70">
                  Please fill out all required fields to submit your research to the repository.
                </p>
              </div>

              <form onSubmit={handleSubmit} className="space-y-6">
                {/* Title */}
                <div className="space-y-2">
                  <Label htmlFor="title" className="text-[#03558C] font-semibold">
                    Research Title <span className="text-red-500">*</span>
                  </Label>
                  <Input
                    id="title"
                    type="text"
                    required
                    placeholder="Enter the full title of your research"
                    className="border-[#03558C]/20 focus:border-[#F8AF21]"
                  />
                </div>

                {/* Author(s) */}
                <div className="space-y-2">
                  <Label htmlFor="authors" className="text-[#03558C] font-semibold">
                    Author(s) <span className="text-red-500">*</span>
                  </Label>
                  <Input
                    id="authors"
                    type="text"
                    required
                    placeholder="Full name(s) of author(s), separated by commas"
                    className="border-[#03558C]/20 focus:border-[#F8AF21]"
                  />
                </div>

                {/* Department & Type */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div className="space-y-2">
                    <Label htmlFor="department" className="text-[#03558C] font-semibold">
                      Department <span className="text-red-500">*</span>
                    </Label>
                    <Select required>
                      <SelectTrigger className="border-[#03558C]/20">
                        <SelectValue placeholder="Select department" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="computer-science">Computer Science</SelectItem>
                        <SelectItem value="engineering">Engineering</SelectItem>
                        <SelectItem value="education">Education</SelectItem>
                        <SelectItem value="environmental-science">Environmental Science</SelectItem>
                        <SelectItem value="business">Business Administration</SelectItem>
                        <SelectItem value="health">Health Sciences</SelectItem>
                        <SelectItem value="other">Other</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="type" className="text-[#03558C] font-semibold">
                      Document Type <span className="text-red-500">*</span>
                    </Label>
                    <Select required>
                      <SelectTrigger className="border-[#03558C]/20">
                        <SelectValue placeholder="Select type" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="research-paper">Research Paper</SelectItem>
                        <SelectItem value="thesis">Thesis</SelectItem>
                        <SelectItem value="dissertation">Dissertation</SelectItem>
                        <SelectItem value="project">Project</SelectItem>
                        <SelectItem value="conference">Conference Paper</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>
                </div>

                {/* Publication Date & Keywords */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div className="space-y-2">
                    <Label htmlFor="date" className="text-[#03558C] font-semibold">
                      Publication Date <span className="text-red-500">*</span>
                    </Label>
                    <Input
                      id="date"
                      type="date"
                      required
                      className="border-[#03558C]/20 focus:border-[#F8AF21]"
                    />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="keywords" className="text-[#03558C] font-semibold">
                      Keywords
                    </Label>
                    <Input
                      id="keywords"
                      type="text"
                      placeholder="e.g., machine learning, agriculture"
                      className="border-[#03558C]/20 focus:border-[#F8AF21]"
                    />
                  </div>
                </div>

                {/* Abstract */}
                <div className="space-y-2">
                  <Label htmlFor="abstract" className="text-[#03558C] font-semibold">
                    Abstract <span className="text-red-500">*</span>
                  </Label>
                  <Textarea
                    id="abstract"
                    required
                    rows={6}
                    placeholder="Provide a brief summary of your research (250-500 words)"
                    className="border-[#03558C]/20 focus:border-[#F8AF21] resize-none"
                  />
                </div>

                {/* File Upload */}
                <div className="space-y-2">
                  <Label htmlFor="file" className="text-[#03558C] font-semibold">
                    Upload Document <span className="text-red-500">*</span>
                  </Label>
                  <div className="border-2 border-dashed border-[#03558C]/20 rounded-lg p-8 text-center hover:border-[#F8AF21]/40 transition-colors">
                    <div className="w-12 h-12 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-3">
                      <FileText className="w-6 h-6 text-[#03558C]" />
                    </div>
                    <p className="text-[#03558C] font-medium mb-1">
                      Click to upload or drag and drop
                    </p>
                    <p className="text-sm text-[#03558C]/60">
                      PDF, DOC, DOCX (max. 50MB)
                    </p>
                    <input
                      id="file"
                      type="file"
                      accept=".pdf,.doc,.docx"
                      className="hidden"
                      required
                    />
                  </div>
                </div>

                {/* Guidelines Notice */}
                <div className="bg-[#F8AF21]/10 border border-[#F8AF21]/30 rounded-lg p-4 flex gap-3">
                  <AlertCircle className="w-5 h-5 text-[#F8AF21] flex-shrink-0 mt-0.5" />
                  <div className="text-sm text-[#03558C]/80">
                    <p className="font-semibold mb-1">Submission Guidelines</p>
                    <p>
                      Please ensure your document follows the repository guidelines. All submissions
                      undergo a review process before publication.
                    </p>
                  </div>
                </div>

                {/* Submit Button */}
                <div className="pt-4">
                  <Button
                    type="submit"
                    className="w-full h-12 bg-[#03558C] hover:bg-[#02447A] text-white"
                  >
                    <UploadIcon className="w-5 h-5 mr-2" />
                    Submit Research
                  </Button>
                </div>
              </form>
            </div>
          )}
        </div>
      </section>
    </div>
  );
}
