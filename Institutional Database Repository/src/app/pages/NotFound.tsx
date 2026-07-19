import { FileQuestion, Home, ArrowLeft } from "lucide-react";
import { Link } from "react-router";
import { Button } from "../components/ui/button";

export function NotFound() {
  return (
    <div className="min-h-screen bg-[#F8F6F2] flex items-center justify-center px-4">
      <div className="text-center max-w-[600px]">
        <div className="w-24 h-24 bg-[#03558C]/10 rounded-full flex items-center justify-center mx-auto mb-6">
          <FileQuestion className="w-12 h-12 text-[#03558C]" />
        </div>
        
        <h1 className="text-6xl font-bold text-[#03558C] mb-4">404</h1>
        <h2 className="text-2xl font-bold text-[#03558C] mb-4">Page Not Found</h2>
        
        <p className="text-lg text-[#03558C]/70 mb-8 leading-relaxed">
          The page you're looking for doesn't exist or has been moved. Please check the URL or
          return to the homepage.
        </p>

        <div className="flex flex-wrap justify-center gap-4">
          <Link to="/">
            <Button className="bg-[#03558C] hover:bg-[#02447A] text-white">
              <Home className="w-4 h-4 mr-2" />
              Go to Homepage
            </Button>
          </Link>
          <Button
            variant="outline"
            onClick={() => window.history.back()}
            className="border-[#03558C]/20"
          >
            <ArrowLeft className="w-4 h-4 mr-2" />
            Go Back
          </Button>
        </div>
      </div>
    </div>
  );
}
