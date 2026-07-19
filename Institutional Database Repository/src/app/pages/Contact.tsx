import { useState } from "react";
import { Mail, Phone, MapPin, Send, CheckCircle } from "lucide-react";
import { Button } from "../components/ui/button";
import { Input } from "../components/ui/input";
import { Label } from "../components/ui/label";
import { Textarea } from "../components/ui/textarea";

export function Contact() {
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
          <h1 className="text-3xl lg:text-4xl font-bold mb-4">Contact Us</h1>
          <p className="text-lg text-white/80">
            Get in touch with our team for assistance, inquiries, or collaboration opportunities.
          </p>
        </div>
      </section>

      {/* Contact Content */}
      <section className="py-16">
        <div className="max-w-[1200px] mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {/* Contact Information */}
            <div>
              <h2 className="text-2xl font-bold text-[#03558C] mb-6">
                Get in Touch
              </h2>
              <p className="text-[#03558C]/70 mb-8 leading-relaxed">
                Have questions about the repository, need technical support, or interested in
                collaboration? We're here to help. Reach out to us using the contact information
                below or fill out the form.
              </p>

              <div className="space-y-6">
                {/* Address */}
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 bg-[#03558C]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <MapPin className="w-6 h-6 text-[#03558C]" />
                  </div>
                  <div>
                    <h3 className="font-bold text-[#03558C] mb-1">Address</h3>
                    <p className="text-[#03558C]/70">
                      Camarines Sur Polytechnic Colleges<br />
                      Nabua, Camarines Sur<br />
                      Philippines, 4434
                    </p>
                  </div>
                </div>

                {/* Email */}
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 bg-[#F8AF21]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <Mail className="w-6 h-6 text-[#F8AF21]" />
                  </div>
                  <div>
                    <h3 className="font-bold text-[#03558C] mb-1">Email</h3>
                    <a
                      href="mailto:repository@cspc.edu.ph"
                      className="text-[#03558C]/70 hover:text-[#F8AF21] transition-colors"
                    >
                      repository@cspc.edu.ph
                    </a>
                    <br />
                    <a
                      href="mailto:support@cspc.edu.ph"
                      className="text-[#03558C]/70 hover:text-[#F8AF21] transition-colors"
                    >
                      support@cspc.edu.ph
                    </a>
                  </div>
                </div>

                {/* Phone */}
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 bg-[#03558C]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <Phone className="w-6 h-6 text-[#03558C]" />
                  </div>
                  <div>
                    <h3 className="font-bold text-[#03558C] mb-1">Phone</h3>
                    <a
                      href="tel:+639123456789"
                      className="text-[#03558C]/70 hover:text-[#F8AF21] transition-colors"
                    >
                      +63 912 345 6789
                    </a>
                    <br />
                    <a
                      href="tel:+639987654321"
                      className="text-[#03558C]/70 hover:text-[#F8AF21] transition-colors"
                    >
                      +63 998 765 4321
                    </a>
                  </div>
                </div>
              </div>

              {/* Office Hours */}
              <div className="mt-10 bg-white rounded-xl p-6 border-2 border-[#03558C]/10">
                <h3 className="font-bold text-[#03558C] mb-3">Office Hours</h3>
                <div className="space-y-2 text-sm text-[#03558C]/70">
                  <div className="flex justify-between">
                    <span>Monday - Friday:</span>
                    <span className="font-semibold">8:00 AM - 5:00 PM</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Saturday:</span>
                    <span className="font-semibold">9:00 AM - 12:00 PM</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Sunday:</span>
                    <span className="font-semibold">Closed</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Contact Form */}
            <div>
              {submitted ? (
                <div className="bg-white rounded-xl p-8 border-2 border-green-500/20 text-center">
                  <div className="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <CheckCircle className="w-8 h-8 text-green-600" />
                  </div>
                  <h3 className="text-2xl font-bold text-[#03558C] mb-3">
                    Message Sent!
                  </h3>
                  <p className="text-[#03558C]/70 mb-6">
                    Thank you for contacting us. We'll get back to you within 1-2 business days.
                  </p>
                  <Button
                    onClick={() => setSubmitted(false)}
                    className="bg-[#03558C] hover:bg-[#02447A] text-white"
                  >
                    Send Another Message
                  </Button>
                </div>
              ) : (
                <div className="bg-white rounded-xl p-8 border-2 border-[#03558C]/10 shadow-lg">
                  <h2 className="text-2xl font-bold text-[#03558C] mb-6">
                    Send Us a Message
                  </h2>

                  <form onSubmit={handleSubmit} className="space-y-5">
                    {/* Name */}
                    <div className="space-y-2">
                      <Label htmlFor="name" className="text-[#03558C] font-semibold">
                        Full Name <span className="text-red-500">*</span>
                      </Label>
                      <Input
                        id="name"
                        type="text"
                        required
                        placeholder="Enter your full name"
                        className="border-[#03558C]/20 focus:border-[#F8AF21]"
                      />
                    </div>

                    {/* Email */}
                    <div className="space-y-2">
                      <Label htmlFor="email" className="text-[#03558C] font-semibold">
                        Email Address <span className="text-red-500">*</span>
                      </Label>
                      <Input
                        id="email"
                        type="email"
                        required
                        placeholder="your.email@example.com"
                        className="border-[#03558C]/20 focus:border-[#F8AF21]"
                      />
                    </div>

                    {/* Subject */}
                    <div className="space-y-2">
                      <Label htmlFor="subject" className="text-[#03558C] font-semibold">
                        Subject <span className="text-red-500">*</span>
                      </Label>
                      <Input
                        id="subject"
                        type="text"
                        required
                        placeholder="Brief subject of your message"
                        className="border-[#03558C]/20 focus:border-[#F8AF21]"
                      />
                    </div>

                    {/* Message */}
                    <div className="space-y-2">
                      <Label htmlFor="message" className="text-[#03558C] font-semibold">
                        Message <span className="text-red-500">*</span>
                      </Label>
                      <Textarea
                        id="message"
                        required
                        rows={5}
                        placeholder="Write your message here..."
                        className="border-[#03558C]/20 focus:border-[#F8AF21] resize-none"
                      />
                    </div>

                    {/* Submit Button */}
                    <Button
                      type="submit"
                      className="w-full h-11 bg-[#03558C] hover:bg-[#02447A] text-white"
                    >
                      <Send className="w-4 h-4 mr-2" />
                      Send Message
                    </Button>
                  </form>
                </div>
              )}
            </div>
          </div>
        </div>
      </section>

      {/* Map Section (Placeholder) */}
      <section className="py-0">
        <div className="w-full h-[400px] bg-[#03558C]/10 flex items-center justify-center">
          <div className="text-center">
            <MapPin className="w-16 h-16 text-[#03558C]/30 mx-auto mb-3" />
            <p className="text-[#03558C]/50 font-medium">Map Location</p>
            <p className="text-sm text-[#03558C]/40">CSPC, Nabua, Camarines Sur</p>
          </div>
        </div>
      </section>
    </div>
  );
}
