<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
  <!-- Background Circle -->
  <circle cx="100" cy="100" r="95" fill="#001d3d" stroke="#003566" stroke-width="3"/>
  
  <!-- Inner Circle -->
  <circle cx="100" cy="100" r="75" fill="#003566" stroke="#ffd60a" stroke-width="2"/>
  
  <!-- Government Building Icon -->
  <g transform="translate(100, 100)">
    <!-- Building Base -->
    <rect x="-35" y="-10" width="70" height="40" fill="#ffd60a" rx="2"/>
    
    <!-- Columns -->
    <rect x="-30" y="-10" width="8" height="40" fill="#ffffff"/>
    <rect x="-15" y="-10" width="8" height="40" fill="#ffffff"/>
    <rect x="0" y="-10" width="8" height="40" fill="#ffffff"/>
    <rect x="15" y="-10" width="8" height="40" fill="#ffffff"/>
    <rect x="30" y="-10" width="8" height="40" fill="#ffffff"/>
    
    <!-- Roof -->
    <polygon points="-40,-15 0,-35 40,-15" fill="#dc2626"/>
    
    <!-- Flag Pole -->
    <rect x="-2" y="-50" width="4" height="15" fill="#374151"/>
    
    <!-- Flag -->
    <polygon points="2,-50 25,-45 2,-40" fill="#dc2626"/>
    
    <!-- Steps -->
    <rect x="-40" y="30" width="80" height="5" fill="#6b7280"/>
    <rect x="-35" y="35" width="70" height="5" fill="#6b7280"/>
    
    <!-- Text Area Background -->
    <rect x="-45" y="45" width="90" height="20" fill="#ffffff" rx="3"/>
  </g>
  
  <!-- Text -->
  <text x="100" y="160" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#001d3d">KECAMATAN</text>
  <text x="100" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" fill="#003566">PEMERINTAH DAERAH</text>
</svg>
