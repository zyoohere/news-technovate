import React from 'react';

const Footer = () => {
  return (
    <footer className="bg-gray-800 border-t border-gray-700 text-sm text-white">
      <div className="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">

        {/* Brand / Description */}
        <div>
             <div className="flex items-center">
          <img
            src="/images/Logoicon.png"
            alt="Technovate Logo"
            className="h-10 w-10 rounded-full shadow-sm"
          />
          <span className="ml-2 text-2xl font-bold text-white">Technovate</span>
        </div>
  
          <p className="mt-2 text-gray-400">
            Telling stories that awaken wonder, nurture wisdom, and bring joy to every heart
          </p>
          <div className="mt-4 flex items-center border border-gray-600 rounded overflow-hidden w-full max-w-xs">
            <div className="px-3">
              <svg className="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" strokeWidth="2"
                viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round"
                  d="M16 12l-4-4-4 4m0 0l4 4 4-4m-4-4v8" />
              </svg>
            </div>
            <input
              type="email"
              placeholder="Your Email"
              className="w-full py-1 px-2 focus:outline-none bg-gray-800 text-white placeholder-gray-400"
            />
            <button type="button" className="bg-gray-700 hover:bg-gray-600 text-white text-sm px-3 py-1">Subscribe</button>
          </div>
        </div>

        {/* Company */}
        <div>
          <h3 className="font-semibold mb-2 text-white">Company</h3>
          <ul className="space-y-1 text-gray-400">
            <li><a href="#">About us</a></li>
            <li><a href="#">Media</a></li>
            <li><a href="#">Careers</a></li>
          </ul>
        </div>

        {/* Social Media */}
        <div>
          <h3 className="font-semibold mb-2 text-white">Social Media</h3>
          <ul className="space-y-1 text-gray-400">
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Youtube</a></li>
            <li><a href="#">Facebook</a></li>
          </ul>
        </div>

        {/* Contact */}
        <div>
          <h3 className="font-semibold mb-2 text-white">Contact us</h3>
          <ul className="space-y-1 text-gray-400">
            <li>+62 ++++++++</li>
            <li>Hello@technovate.co</li>
            <li>Indonesia, Jawa Barat - Kota Bandung</li>
          </ul>
        </div>
      </div>

      <div className="border-t border-gray-700 py-3 px-4 text-xs flex flex-col md:flex-row justify-between max-w-7xl mx-auto text-gray-400">
        <div className="flex space-x-4 mb-2 md:mb-0">
          <a href="#" className="hover:underline">Syarat & Ketentuan</a>
          <a href="#" className="hover:underline">Kebijakan Privasi</a>
        </div>
        <div>© 2025 Technovate! All rights Reserved</div>
      </div>
    </footer>
  );
};

export default Footer;
