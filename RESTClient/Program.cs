using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Security.Policy;
using System.Text;
using System.Threading.Tasks;

using Newtonsoft.Json;

namespace RESTClient
{
    class student
    {
        public int id;
        public string name;
        public string klasse;
    }

    internal class Program
    {
        public static string GET()
        {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/rest/simpleserver.php");
            var response = (HttpWebResponse)request.GetResponse();
            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();
            return responseString;
        }

        public static string POST(string sendData)
        {
            var request = (HttpWebRequest)WebRequest.Create("http://localhost/rest/simpleserver.php");

            var postData = Encoding.UTF8.GetBytes(sendData);

            request.Method = "POST";
            request.ContentLength = postData.Length;
            request.ContentType = "application/json";

            using (var stream = request.GetRequestStream())
            {
                stream.Write(postData, 0, postData.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();
            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();
            return responseString;

        }

        static void Main(string[] args)
        {
            string control = "send";

            if (control == "receive")
            {
                string responseGET = GET();
                Console.WriteLine(responseGET);

                List<student> returnList = new List<student>();

                returnList = JsonConvert.DeserializeObject<List<student>>(responseGET);

                foreach (student student in returnList)
                {
                    Console.WriteLine("id: {0} name: {1} class: {2}",student.id, student.name, student.klasse);
                }

                Console.ReadKey();
            }
            else if (control == "send")
            {
                student newStudent = new student();
                newStudent.name = "Sascha Müller";
                newStudent.klasse = "4CK";

                string json = JsonConvert.SerializeObject(newStudent);
                Console.WriteLine(json);

                POST(json);

                Console.ReadKey();
            }

        }
    }
}
