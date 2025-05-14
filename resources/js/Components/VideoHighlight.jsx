import React from 'react';


export default function VideoHighlight({ videos }) {
  const getYouTubeEmbed = (url) => {
    const regExp = /(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\/)([^&#]*)/;
    const match = url.match(regExp);
    return match ? `https://www.youtube.com/embed/${match[1]}` : '';
  };

  return (
    <section className="container mx-auto px-4 py-8">
      <h2 className="text-xl font-bold mb-6 border-b pb-2">Video Hightlighy</h2>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

          {videos.type === 'upload' ? (
        <video controls   key={videos.id}
            className="border rounded-lg overflow-hidden shadow hover:shadow-md transition">
          <source src={`/storage/videos/${videos.video_path}`} type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      ) : (
        <iframe
          className="w-full aspect-video rounded h-48 object-cover"
          src={getYouTubeEmbed(videos.video_url)}
          title={videos.title}
          frameBorder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        ></iframe>
      )}
          <p className="mt-1 text-sm text-gray-600">{videos.description}</p>
        
        
        
        
        
        {/* {videoData.map((video) => (
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
        ))} */}
      </div>
    </section>
  );
}

