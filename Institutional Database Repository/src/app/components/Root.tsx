import { Outlet } from "react-router";
import { Header } from "./Header";
import { Footer } from "./Footer";

export function Root() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1 pt-[78px]">
        <Outlet />
      </main>
      <Footer />
    </div>
  );
}
