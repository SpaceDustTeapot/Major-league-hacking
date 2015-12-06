import java.net.*;
import java.util.ArrayList;
import java.util.Scanner;
import java.io.*;

public class URLConnectionReader {
    public static String getText(String url) throws Exception {
        URL website = new URL(url);
        URLConnection connection = website.openConnection();
        BufferedReader in = new BufferedReader(
                                new InputStreamReader(
                                    connection.getInputStream()));

        StringBuilder response = new StringBuilder();
        String inputLine;

        while ((inputLine = in.readLine()) != null) 
            response.append(inputLine);

        in.close();

        return response.toString();
    }

    public static void main(String[] args) throws Exception {
        String content = URLConnectionReader.getText("http://192.168.72.49/xampp/api_req.php?lat=53.455028&long=-2.233534&sesh=0");
        //System.out.println(content);

        ArrayList<Double> dynamicArray = new ArrayList<Double>();
        
        for(String s : content.split("(?=<)|(?<=>)")){
        	if (!s.contains("<"))
        	{
        		dynamicArray.add(Double.parseDouble(s));
                System.out.println(s);
        	}
        }
              
        int newIndex = 0;
        for (double d : dynamicArray)
        {
        	if (newIndex == 0)
        		
        	
        	
        	
        	newIndex = (newIndex+1) % 3;
        }
        
        
        
    }
}