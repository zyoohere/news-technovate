import { Head } from "@inertiajs/react";
import React from "react";
import Navbar from "@/Components/Navbar";
import Footer from "@/Layouts/Footer";
import VideoHighlight from "@/Components/VideoHighlight";

export default function Home({ title, categories }) {
  return (
    <>
      <Head title="Home" />
      <div>
      </div>
      <Navbar title={title} categories={categories} />

      {/* Section Trending & Popular */}
      <section className="container mx-auto px-4 py-6">
        <h3 className="text-lg font-semibold">Popular</h3>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {/* Trending Article */}
          <div className="md:col-span-2 border rounded-lg overflow-hidden shadow-sm">

            <img
              src="\images\News (1).jpg"
              alt="TikTok"
              className="w-full h-64 object-cover"
            />
            <div className="p-4">
              <h2 className="text-xl font-bold">
                TikTok Sumber Berita Favorit Bagi Generasi Z
              </h2>
              <p className="text-sm text-gray-700 mt-2">
                Menurut Luc Cain, Pendiri Charlesbye Strategy and Research Interactive, Generasi Z mendapatkan berita dari sumber yang terfragmentasi dan seringkali kurang dapat dipercaya...
              </p>
            </div>
          </div>

          {/* Popular Sidebar */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold">Popular</h3>
            {[1, 2, 3].map((item) => (
              <div key={item} className="flex gap-3 items-start border p-2 rounded hover:bg-gray-50 transition">
                <img
                  src="\images\News (2).jpg"
                  alt="Popular Article"
                  className="w-16 h-16 object-cover rounded"
                />
                <p className="text-sm font-medium">
                  {item === 1 && "Musim 2025 mencakup 21 seri balapan di berbagai negara."}
                  {item === 2 && "Jadwal Timnas Indonesia Vs China pada Kualifikasi Piala Dunia 2026: Duel Hidup-Mati"}
                  {item === 3 && "Emas Cetak Rekor Tertinggi: Sinyal Krisis atau Peluang Investasi?"}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Video */}
      <VideoHighlight />

      {/* Card Horizontal */}
      <div className="mx-auto max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-2xl">
        <div className="md:flex">
          <div className="md:shrink-0">
            <img
              className="h-48 w-full object-cover md:h-full md:w-48"
              src="/example.jpg"
              alt="Modern building architecture"
            />
          </div>
          <div className="p-8">
            <div className="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Company retreats</div>
            <a href="#" className="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
              Incredible accommodation for your team
            </a>
            <p className="mt-2 text-gray-500">
              Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
              places to do just that.
            </p>
          </div>
        </div>
      </div>

      {/* Category Section */}
      <div className="container mx-auto px-4 py-8">
        <h2 className="text-lg font-bold mb-4 text-center">Category</h2>
        <div className="grid md:grid-cols-1 lg:grid-cols-4 gap-6">
          {/* Teknologi Masa Kini */}
          <CategoryCard
            title="Teknologi Masa Kini"
            image="\images\News (5).jpg"
            text="Teknologi berkembang pesat..."
            tags={["#Tech", "#Teknologi"]}
          />

          {/* Masa Depan Ekonomi */}
          <CategoryCard
            title="Masa Depan Ekonomi"
            image="\images\News (4).jpg"
            text="Ekonomi dunia kini berada di tengah perubahan besar..."
            tags={["#economy", "#saham"]}
          />

          {/* Empat Pemain Cedera */}
          <CategoryCard
            title="Empat Pemain Cedera"
            image="\images\News (6).jpg"
            text="Timnas Indonesia menghadapi sejumlah tantangan..."
            tags={["#football"]}
          />

          {/* Percaya Diri */}
          <CategoryCard
            title="Percaya Diri, Kunci Sukses"
            image="\images\News (8).jpg"
            text="Artikel ini membahas pentingnya self confidence..."
            tags={["#health", "#confidence"]}
          />
        </div>
      </div>

      {/* Section Grid Teknologi */}
      <section className="text-center px-4 mb-10">
        <h3 className="font-semibold mb-3">Teknologi Masa Kini</h3>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {[
            { img: "\images\News (2).jpg", text: "Teknologi berkembang pesat...", tags: ["#Tech", "#Teknologi"] },
            { img: "\images\News (10).jpg", text: "AI dan otomatisasi kini menjadi bagian dari kehidupan...", tags: ["#AI", "#Automation"] },
            { img: "\images\News (5).jpg", text: "Pengaruh teknologi terhadap pendidikan modern...", tags: ["#EdTech"] },
            { img: "\images\News (6).jpg", text: "Gadget masa kini semakin terintegrasi dengan AI...", tags: ["#Gadget", "#SmartTech"] }
          ].map((card, i) => (
            <div key={i} className="border rounded-lg p-4 shadow hover:shadow-lg transition">
              <img src={card.img} className="w-full h-40 object-cover rounded mb-3" alt="" />
              <p className="text-sm text-gray-600">{card.text}</p>
              <div className="mt-2 text-xs text-teal-600 space-x-2">
                {card.tags.map((tag, j) => <span key={j}>{tag}</span>)}
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* Footer */}
      <Footer />
     
    </>
  );
}

const CategoryCard = ({ title, image, text, tags }) => (
  <section className="text-center">
    <h3 className="font-semibold mb-3">{title}</h3>
    <div className="grid grid-cols-1 gap-6">
      <div className="border rounded-lg p-4 shadow hover:shadow-lg transition">
        <img src={image} alt={title} className="w-full h-40 object-cover rounded mb-3" />
        <p className="text-sm text-gray-600">{text}</p>
        <div className="mt-2 text-xs text-teal-600 space-x-2">
          {tags.map((tag, i) => <span key={i}>{tag}</span>)}
        </div>
      </div>
    </div>
  </section>
);
