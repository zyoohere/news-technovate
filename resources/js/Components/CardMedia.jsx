import React from 'react';

export default function CardMedia({ video }) {
  const getYouTubeEmbed = (url) => {
    const regExp = /(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\/)([^&#]*)/;
    const match = url.match(regExp);
    return match ? `https://www.youtube.com/embed/${match[1]}` : '';
  };

  return (
    <div className="rounded-xl shadow p-4 bg-white">
      <h2 className="text-lg font-semibold mb-2">{video.title}</h2>
      {video.type === 'upload' ? (
        <video controls className="w-full h-auto rounded">
          <source src={`/storage/videos/${video.video_path}`} type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      ) : (
        <iframe
          className="w-full aspect-video rounded"
          src={getYouTubeEmbed(video.video_url)}
          title={video.title}
          frameBorder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        ></iframe>
      )}
      <p className="mt-2 text-sm text-gray-600">{video.description}</p>
    </div>
  );
}
