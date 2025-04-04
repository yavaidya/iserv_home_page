const fs = require("fs");
const path = require("path");

const SENSITIVE_PATTERNS = [
  /API_KEY\s*=\s*["'][A-Za-z0-9_-]+["']/g,      // Generic API key
  /SECRET_KEY\s*=\s*["'][A-Za-z0-9_-]+["']/g,   // Generic Secret key
  /AWS_ACCESS_KEY_ID\s*=\s*["'][A-Z0-9]{20}["']/g, // AWS Access Key
  /AWS_SECRET_ACCESS_KEY\s*=\s*["'][A-Za-z0-9/+]{40}["']/g, // AWS Secret Key
  /ghp_[a-zA-Z0-9]{36}/g, // GitHub Personal Access Token
  /github_pat_[a-zA-Z0-9]{22,}/g, // GitHub Token (New Format)
  /gho_[a-zA-Z0-9]{36}/g, // GitHub OAuth Token
  /slack_api_token\s*=\s*["'][a-zA-Z0-9-]+["']/g, // Slack Token
  /db_password\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Database Passwords
  /BEGIN\s+PRIVATE\s+KEY/g, // Private Keys
  /password\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Generic Password
  /ftp_password\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // FTP Passwords
  /SMTP_PASSWORD\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // SMTP Passwords
  /private_key\s*=\s*["'][A-Za-z0-9/+]{64}["']/g, // Base64 Encoded Private Key
  /RDP_PASSWORD\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // RDP Credentials
  /ssh_private_key\s*=\s*["'][A-Za-z0-9+/=]+["']/g, // SSH Private Key (Base64)
  /token\s*=\s*["'][A-Za-z0-9_-]{32,}["']/g, // Generic Token
  /bearer\s*=\s*["'][A-Za-z0-9_-]{32,}["']/g, // Bearer Token
  /API_URL\s*=\s*["'](https?:\/\/)?([A-Za-z0-9.-]+)(:\d+)?(\/\S*)?["']/g, // Hardcoded URL (API URL)
  /webhook_url\s*=\s*["'](https?:\/\/)?([A-Za-z0-9.-]+)(:\d+)?(\/\S*)?["']/g, // Webhook URL
  /db_connection_string\s*=\s*["'](mongodb|postgresql|mysql|mssql):\/\/[A-Za-z0-9]+:[A-Za-z0-9!@#$%^&*()_+=-]+@[A-Za-z0-9.-]+\/[A-Za-z0-9_-]+["']/g, // Database connection string
  /jwt_secret\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]{32,}["']/g, // JWT Secret Key
  /client_id\s*=\s*["'][A-Za-z0-9]{16,}["']/g, // OAuth Client ID
  /client_secret\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]{32,}["']/g, // OAuth Client Secret
  /password_hash\s*=\s*["'][A-Za-z0-9$./]{60,}["']/g, // Password hash (bcrypt, etc.)
  /api_secret\s*=\s*["'][A-Za-z0-9]{32,}["']/g, // API Secret
  /mongo_uri\s*=\s*["']mongodb:\/\/[A-Za-z0-9]+:[A-Za-z0-9!@#$%^&*()_+=-]+@[A-Za-z0-9.-]+\/[A-Za-z0-9_-]+["']/g, // MongoDB URI
  /redis_password\s*=\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Redis Password
  /push_api_key\s*=\s*["'][A-Za-z0-9_-]+["']/g, // Push Notification API Key
  /google_api_key\s*=\s*["'][A-Za-z0-9_-]{39}["']/g, // Google API Key
  /db_pass\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // DB Password
  /db_passphrase\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // DB Passphrase
  /DB_PASS\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // DB Pass (uppercase)
  /DB_PASSWORD\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // DB Password (uppercase)
  /pass\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Generic Pass
  /PASSWORD\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Password (uppercase)
  /PASS\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Password (uppercase)
  /passphrase\s*[:=]\s*["'][A-Za-z0-9!@#$%^&*()_+=-]+["']/g, // Passphrase
];




const CODE_EXTENSIONS = [
  ".js", ".ts", ".py", ".php", ".html", ".css", ".json", ".yaml", ".yml",
  ".xml", ".env", ".sh", ".bash", ".bat", ".java", ".c", ".cpp", ".cs", ".rb",
  ".go", ".rs", ".kt", ".swift", ".pl", ".sql", ".dockerfile", ".config"
];


// function scanFile(filePath) {
//   console.log(`🔍 Scanning: ${filePath}`); // Log every scanned file
//   const content = fs.readFileSync(filePath, "utf8");
//   const lines = content.split('\n'); // Split content into lines

//   // Loop through each line and check against the patterns
//   for (let lineNumber = 0; lineNumber < lines.length; lineNumber++) {
//     const line = lines[lineNumber];

//     for (const pattern of SENSITIVE_PATTERNS) {
//       if (pattern.test(line)) {
//         console.log(`🚨 Secret or Hardcoded URLs detected in: ${filePath} (Line ${lineNumber + 1})`);
//         console.log(`Line: ${line.trim()}`);
//         process.exit(1); // Fail the action if a secret is found
//       }
//     }
//   }
// }



// function scanDirectory(dir) {
//   fs.readdirSync(dir).forEach((file) => {
//     const fullPath = path.join(dir, file);
//     if (fs.statSync(fullPath).isDirectory()) {
//       scanDirectory(fullPath);
//     } else if (CODE_EXTENSIONS.some(ext => fullPath.endsWith(ext))) {
//       scanFile(fullPath);
//     }
//   });
// }

// Start scanning from the repository root directory
// scanDirectory(process.cwd());
// console.log("✅ No secrets detected.");


function scanFile(filePath) {
  console.log(`🔍 Scanning: ${filePath}`);
  const content = fs.readFileSync(filePath, "utf8");
  const lines = content.split('\n');
  let found = false;

  for (let lineNumber = 0; lineNumber < lines.length; lineNumber++) {
    const line = lines[lineNumber];

    for (const pattern of SENSITIVE_PATTERNS) {
      if (pattern.test(line)) {
        console.log(`🚨 Secret or Hardcoded URL detected in: ${filePath} (Line ${lineNumber + 1})`);
        console.log(`Line: ${line.trim()}`);
        found = true;
      }
    }
  }

  return found;
}

function scanDirectory(dir) {
  let errorsFound = false;

  fs.readdirSync(dir).forEach((file) => {
    const fullPath = path.join(dir, file);
    if (fs.statSync(fullPath).isDirectory()) {
      errorsFound = scanDirectory(fullPath) || errorsFound;
    } else if (CODE_EXTENSIONS.some(ext => fullPath.endsWith(ext))) {
      errorsFound = scanFile(fullPath) || errorsFound;
    }
  });

  return errorsFound;
}

// Start scanning from the repository root directory
const errors = scanDirectory(process.cwd(), []);

// If errors were found, fail the action
if (errors) {
  console.log("🚨 Errors detected in the codebase.");
  process.exit(1); // Fail the action
} else {
  console.log("✅ No secrets detected.");
}
