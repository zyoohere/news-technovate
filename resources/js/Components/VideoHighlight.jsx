import React from 'react';

const videoData = [
  {
    id: 1,
    title: "Video 1",
    desc: "Deskripsi singkat video 1.",
    thumbnail: "/videos/thumb1.jpg",
  },
  {
    id: 2,
    title: "Video 2",
    desc: "Deskripsi singkat video 2.",
    thumbnail: "/videos/thumb2.jpg",
  },
  {
    id: 3,
    title: "Video 3",
    desc: "Deskripsi singkat video 3.",
    thumbnail: "/videos/thumb3.jpg",
  },
];

const VideoHighlight = () => {
  return (
    <section className="container mx-auto px-4 py-8">
      <h2 className="text-xl font-bold mb-6 border-b pb-2">🎬 Video Highlight</h2>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        {videoData.map((video) => (
          <div
            key={video.id}
            className="border rounded-lg overflow-hidden shadow hover:shadow-md transition"
          >
            <img
              src={video.thumbnail}
              alt={video.title}
              className="w-full h-48 object-cover"
            />
            <div className="p-4">
              <h3 className="font-semibold text-md">{video.title}</h3>
              <p className="text-sm text-gray-600 mt-1">{video.desc}</p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
};

export default VideoHighlight;
