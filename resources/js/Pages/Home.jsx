import { Head } from "@inertiajs/react";
import React from "react";
import Navbar from "@/Components/Navbar";
import Footer from "@/Layouts/Footer";
import VideoHighlight from "@/Components/VideoHighlight";

export default function Home({ title, categories, articles, videos }) {
  return (
    <>
      <Head title="Home" />
      <Navbar title={title} categories={categories} />

      {/* Hero Section */}
      <section className="bg-gray-100 py-12">
        <div className="container mx-auto px-4 text-center">
          <h1 className="text-3xl font-bold mb-4">Welcome to Technovate News</h1>
          <p className="text-gray-600">Stay updated with the latest trends in technology, economy, and more.</p>
        </div>
      </section>

      {/* Popular Articles */}
      <section className="container mx-auto px-4 py-8">
        <h3 className="text-2xl font-semibold mb-6">Popular Articles</h3>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {articles.slice(0, 1).map((articles) => (
            <div key={articles.id} className="md:col-span-2 border rounded-lg overflow-hidden shadow-lg">
              <img
                src={`http://localhost:8000/storage/${articles.thumbnail}`}
                alt={articles.title}
                className="w-full h-64 object-cover"
              />
              <div className="p-4">
                <h2 className="text-xl font-bold mb-2">{articles.title}</h2>
                <div className="prose max-w-none text-gray-700">
                  <div dangerouslySetInnerHTML={{ __html: articles.content }} />
                </div>
              </div>
            </div>
          ))}
          <div className="space-y-4">
            <h3 className="text-2xl font-semibold">Popular Articles</h3>
            {articles.slice(0, 3).map((articles) => (
              <div
                key={articles.id}
                className="flex gap-4 items-start border p-4 rounded-lg hover:bg-gray-50 transition"
              >
                <img
                  src={`http://localhost:8000/storage/${articles.thumbnail}`}
                  alt={articles.title}
                  className="w-20 h-20 object-cover rounded"
                />
                <div>
                  <h4 className="font-bold text-lg">{articles.title}</h4>
                  <p className="text-sm text-gray-500">{articles.user?.nama}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Video Highlight */}
      {/* <VideoHighlight videos={videos} /> */}

      <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        {videos.map(videos => (
          <VideoHighlight key={videos.id} videos={videos} />
        ))}
      </div>
      {/* Featured Card */}
      <div className="mx-auto max-w-4xl overflow-hidden rounded-xl bg-white shadow-md md:flex my-8">
        <img
          className="h-48 w-full object-cover md:h-auto md:w-48"
          src="/example.jpg"
          alt="Modern building architecture"
        />
        <div className="p-8">
          <h3 className="text-indigo-500 text-sm font-semibold uppercase">Company Retreats</h3>
          <a href="#" className="block mt-2 text-lg font-medium text-black hover:underline">
            Incredible accommodation for your team
          </a>
          <p className="mt-2 text-gray-600">
            Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
            places to do just that.
          </p>
        </div>
      </div>

      {/* Categories */}
      <section className="container mx-auto px-4 py-8">
        <h2 className="text-2xl font-bold mb-6 text-center">Explore Categories</h2>
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <CategoryCard
            title="Teknologi Masa Kini"
            image="\images\News (5).jpg"
            text="Teknologi berkembang pesat..."
            tags={["#Tech", "#Teknologi"]}
          />
          <CategoryCard
            title="Masa Depan Ekonomi"
            image="\images\News (4).jpg"
            text="Ekonomi dunia kini berada di tengah perubahan besar..."
            tags={["#Economy", "#Saham"]}
          />
          <CategoryCard
            title="Empat Pemain Cedera"
            image="\images\News (6).jpg"
            text="Timnas Indonesia menghadapi sejumlah tantangan..."
            tags={["#Football"]}
          />
          <CategoryCard
            title="Percaya Diri, Kunci Sukses"
            image="\images\News (8).jpg"
            text="Artikel ini membahas pentingnya self confidence..."
            tags={["#Health", "#Confidence"]}
          />
        </div>
      </section>

      {/* Technology Highlights */}
      <section className="bg-gray-50 py-10">
        <div className="container mx-auto px-4 text-center">
          <h3 className="text-2xl font-semibold mb-6">Teknologi Masa Kini</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { img: "\images\News (2).jpg", text: "Teknologi berkembang pesat...", tags: ["#Tech", "#Teknologi"] },
              { img: "\images\News (10).jpg", text: "AI dan otomatisasi kini menjadi bagian dari kehidupan...", tags: ["#AI", "#Automation"] },
              { img: "\images\News (5).jpg", text: "Pengaruh teknologi terhadap pendidikan modern...", tags: ["#EdTech"] },
              { img: "\images\News (6).jpg", text: "Gadget masa kini semakin terintegrasi dengan AI...", tags: ["#Gadget", "#SmartTech"] },
            ].map((card, i) => (
              <div key={i} className="border rounded-lg p-4 shadow hover:shadow-lg transition">
                <img src={card.img} className="w-full h-40 object-cover rounded mb-3" alt="" />
                <p className="text-sm text-gray-600">{card.text}</p>
                <div className="mt-2 text-xs text-teal-600 space-x-2">
                  {card.tags.map((tag, j) => (
                    <span key={j}>{tag}</span>
                  ))}
                </div>
              </div>
            ))}
          </div>
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
